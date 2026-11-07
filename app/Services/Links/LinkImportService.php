<?php

namespace App\Services\Links;

use App\Models\Link;
use App\Models\LinkCategory;
use App\Models\LinkFolder;
use App\Models\LinkTag;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * Imports portable link records from JSON or CSV. A group import is simply
 * one transaction that creates ordinary team-owned links; it is not a
 * separate campaign domain.
 */
class LinkImportService
{
    public function import(int $teamId, int $userId, array $document, array $mappingRows = []): int
    {
        $records = $document['records'] ?? $document['links'] ?? null;

        if (! is_array($records) || ! array_is_list($records) || $records === []) {
            throw ValidationException::withMessages([
                'importContent' => 'در فایل واردشونده باید آرایه‌ای غیرخالی با نام records وجود داشته باشد.',
            ]);
        }

        $defaults = is_array($document['defaults'] ?? null) ? $document['defaults'] : [];
        $defaultFolder = $this->firstFilled($document, ['folder'], $this->firstFilled($defaults, ['folder']));
        $defaultUrl = $this->firstFilled($document, ['destination_url'], $this->firstFilled($defaults, ['destination_url', 'url']));
        $defaultTracking = is_array($document['tracking'] ?? null) ? $document['tracking'] : [];
        $defaultUtm = is_array($defaults['utm'] ?? null) ? $defaults['utm'] : (is_array($document['utm_defaults'] ?? null) ? $document['utm_defaults'] : []);
        $mappingRules = $this->mappingRowsToRules($mappingRows);

        return DB::transaction(function () use ($records, $teamId, $userId, $defaultFolder, $defaultUrl, $defaultTracking, $defaultUtm, $mappingRules) {
            $folders = [];
            $categories = [];
            $tags = [];
            $created = 0;

            foreach ($records as $index => $record) {
                if (! is_array($record)) {
                    throw ValidationException::withMessages([
                        'importContent' => 'ردیف '.($index + 1).' باید یک شیء/سطر داده باشد.',
                    ]);
                }

                $url = $this->firstFilled($record, ['url', 'destination_url', 'original_url'], $defaultUrl);
                if (mb_strlen($url) > 2048 || ! filter_var($url, FILTER_VALIDATE_URL) || ! in_array(strtolower((string) parse_url($url, PHP_URL_SCHEME)), ['http', 'https'], true)) {
                    throw ValidationException::withMessages([
                        'importContent' => 'نشانی مقصد در ردیف '.($index + 1).' معتبر نیست.',
                    ]);
                }

                $folderName = $this->firstFilled($record, ['folder', 'folder_name'], $defaultFolder);
                $folderId = null;
                if ($folderName !== '') {
                    $folderId = $folders[$folderName] ??= LinkFolder::query()->firstOrCreate(
                        ['team_id' => $teamId, 'name' => mb_substr($folderName, 0, 100)],
                    )->id;
                }

                $categoryName = $this->firstFilled($record, ['category', 'category_name']);
                $categoryId = null;
                if ($categoryName !== '') {
                    $categorySlug = Str::slug($categoryName) ?: 'category-'.substr(sha1($categoryName), 0, 10);
                    $category = $categories[$categorySlug] ??= LinkCategory::query()
                        ->where('team_id', $teamId)
                        ->where('slug', $categorySlug)
                        ->first();
                    if (! $category) {
                        throw ValidationException::withMessages([
                            'importContent' => 'دسته‌بندی «'.$categoryName.'» در بخش مدیریت منابع گروه ساخته نشده است.',
                        ]);
                    }
                    $categoryId = $category->id;
                }

                $expiresAt = null;
                $expiryInput = $this->firstFilled($record, ['expires_at']);
                if ($expiryInput !== '') {
                    try {
                        $expiresAt = Carbon::parse($expiryInput);
                    } catch (\Throwable) {
                        throw ValidationException::withMessages([
                            'importContent' => 'زمان انقضا در ردیف '.($index + 1).' معتبر نیست.',
                        ]);
                    }
                }

                $metadata = $this->extractMetadata($record);
                $utmInput = is_array($record['utm'] ?? null)
                    ? $record['utm']
                    : (is_array($record['utm_defaults'] ?? null) ? $record['utm_defaults'] : []);
                $utm = $this->filterUtm($utmInput);
                $csvUtm = [];
                foreach ($record as $key => $value) {
                    if (str_starts_with(strtolower((string) $key), 'utm_') && is_scalar($value) && trim((string) $value) !== '') {
                        $csvUtm[$key] = (string) $value;
                    }
                }
                $metadata['utm_defaults'] = array_merge($this->filterUtm($defaultUtm), $utm, $this->filterUtm($csvUtm));
                if ($metadata['utm_defaults'] === []) {
                    unset($metadata['utm_defaults']);
                }

                $rowTrackingJson = [];
                if (is_string($record['tracking_json'] ?? null) && trim($record['tracking_json']) !== '') {
                    try {
                        $decodedRules = json_decode($record['tracking_json'], true, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException) {
                        throw ValidationException::withMessages([
                            'importContent' => 'ساختار tracking_json در ردیف '.($index + 1).' معتبر نیست.',
                        ]);
                    }
                    if (! is_array($decodedRules)) {
                        throw ValidationException::withMessages([
                            'importContent' => 'مقدار tracking_json در ردیف '.($index + 1).' باید یک شیء JSON باشد.',
                        ]);
                    }
                    $rowTrackingJson = $decodedRules;
                }
                $rowUtmRules = $this->mergeTrackingRules(
                    $this->templateRules($utmInput, 'utm'),
                    $this->templateRules($csvUtm, 'utm'),
                );
                $rowGetRules = $this->templateRules(
                    is_array($record['get'] ?? null) ? $record['get'] : (is_array($record['query'] ?? null) ? $record['query'] : []),
                    'query',
                );

                $rules = $this->mergeTrackingRules(
                    $defaultTracking,
                    $this->templateRules($defaultUtm, 'utm'),
                    is_array($record['tracking'] ?? null) ? $record['tracking'] : [],
                    is_array($record['tracking_rules'] ?? null) ? $record['tracking_rules'] : [],
                    $rowTrackingJson,
                    $rowUtmRules,
                    $rowGetRules,
                    $mappingRules,
                    $this->csvGetRules($record),
                );

                $customCode = $this->firstFilled($record, ['custom_url', 'custom_code', 'short_code', 'code']);
                if ($customCode !== '' && (! preg_match('/^[A-Za-z0-9_-]{3,32}$/', $customCode) || in_array(strtolower($customCode), Link::RESERVED, true))) {
                    throw ValidationException::withMessages([
                        'importContent' => 'کد کوتاه در ردیف '.($index + 1).' معتبر نیست.',
                    ]);
                }
                if ($customCode !== '' && Link::query()->where('code', $customCode)->exists()) {
                    throw ValidationException::withMessages([
                        'importContent' => 'کد کوتاه «'.$customCode.'» در ردیف '.($index + 1).' قبلاً استفاده شده است.',
                    ]);
                }

                $link = Link::query()->create([
                    'team_id' => $teamId,
                    'created_by' => $userId,
                    'folder_id' => $folderId,
                    'category_id' => $categoryId,
                    'code' => $customCode !== '' ? $customCode : Link::generateCode(),
                    'original_url' => $url,
                    'title' => mb_substr($this->firstFilled($record, ['title']), 0, 255) ?: null,
                    'expires_at' => $expiresAt,
                    'metadata' => $metadata !== [] ? $metadata : null,
                    'tracking_rules' => $rules !== [] ? $rules : null,
                ]);

                $tagNames = $record['tags'] ?? null;
                if ($tagNames === null || $tagNames === '' || $tagNames === []) {
                    $tagNames = $record['labels'] ?? [];
                }
                if (is_string($tagNames)) {
                    $tagNames = preg_split('/[,،;|\n]+/u', $tagNames) ?: [];
                }
                if (is_array($tagNames)) {
                    $tagIds = [];
                    foreach ($tagNames as $tagName) {
                        if (! is_scalar($tagName) || trim((string) $tagName) === '') {
                            continue;
                        }
                        $tagName = mb_substr(trim((string) $tagName), 0, 60);
                        $tagSlug = Str::slug($tagName) ?: 'tag-'.substr(sha1(mb_strtolower($tagName)), 0, 10);
                        $tag = $tags[$tagSlug] ??= LinkTag::query()
                            ->where('team_id', $teamId)
                            ->where('slug', $tagSlug)
                            ->first();
                        if (! $tag) {
                            throw ValidationException::withMessages([
                                'importContent' => 'برچسب «'.$tagName.'» در بخش مدیریت منابع گروه ساخته نشده است.',
                            ]);
                        }
                        $tagIds[] = $tag->id;
                    }
                    $link->tags()->sync(array_values(array_unique($tagIds)));
                }

                $created++;
            }

            return $created;
        });
    }

    /** Parse UTF-8 JSON or CSV content into a common document shape. */
    public function parse(string $contents, string $format): array
    {
        $contents = preg_replace('/^\xEF\xBB\xBF/', '', $contents) ?? $contents;

        if ($format === 'json') {
            try {
                $document = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
            } catch (\JsonException $exception) {
                throw ValidationException::withMessages(['importContent' => 'ساختار JSON معتبر نیست: '.$exception->getMessage()]);
            }

            if (! is_array($document)) {
                throw ValidationException::withMessages(['importContent' => 'محتوای JSON باید یک شیء شامل records باشد.']);
            }

            if (array_is_list($document)) {
                return ['records' => $document];
            }

            return $document;
        }

        $stream = fopen('php://temp', 'r+');
        fwrite($stream, $contents);
        rewind($stream);
        $firstLine = (string) fgets($stream);
        $delimiter = ',';
        $bestColumnCount = count(str_getcsv($firstLine, ','));
        foreach ([';', "\t"] as $candidate) {
            $candidateCount = count(str_getcsv($firstLine, $candidate));
            if ($candidateCount > $bestColumnCount) {
                $delimiter = $candidate;
                $bestColumnCount = $candidateCount;
            }
        }
        rewind($stream);
        $headers = fgetcsv($stream, 0, $delimiter);
        if (! is_array($headers) || $headers === []) {
            fclose($stream);
            throw ValidationException::withMessages(['importContent' => 'فایل CSV خالی است یا سطر عنوان ستون‌ها را ندارد.']);
        }

        $headers = array_map(fn ($header) => trim((string) $header), $headers);
        $records = [];
        while (($values = fgetcsv($stream, 0, $delimiter)) !== false) {
            if ($values === [null] || $values === []) {
                continue;
            }
            $values = array_pad($values, count($headers), null);
            $record = [];
            foreach ($headers as $position => $header) {
                if ($header !== '') {
                    $record[$header] = is_string($values[$position] ?? null) ? trim($values[$position]) : ($values[$position] ?? null);
                }
            }
            if (collect($record)->filter(fn ($value) => $value !== null && $value !== '')->isNotEmpty()) {
                $records[] = $record;
            }
        }
        fclose($stream);

        return ['records' => $records];
    }

    private function firstFilled(array $record, array $keys, string $fallback = ''): string
    {
        foreach ($keys as $key) {
            $value = $record[$key] ?? null;
            if (is_scalar($value) && trim((string) $value) !== '') {
                return trim((string) $value);
            }
        }

        return trim($fallback);
    }

    private function extractMetadata(array $record): array
    {
        $metadata = is_array($record['metadata'] ?? null) ? $record['metadata'] : (is_array($record['data'] ?? null) ? $record['data'] : []);
        $reserved = [
            'url', 'destination_url', 'original_url', 'custom_url', 'short_url', 'custom_code', 'short_code', 'code',
            'title', 'expires_at', 'folder', 'folder_name', 'category', 'category_name', 'tags', 'labels',
            'metadata', 'data', 'utm', 'utm_defaults', 'tracking', 'tracking_rules', 'get', 'query', 'tracking_json', 'short_url',
        ];

        foreach ($record as $key => $value) {
            if (str_starts_with((string) $key, 'meta_')) {
                $metadata[substr((string) $key, 5)] = $value;
                continue;
            }
            if (in_array($key, $reserved, true) || str_starts_with(strtolower((string) $key), 'utm_') || str_starts_with(strtolower((string) $key), 'get_')) {
                continue;
            }
            if (! array_key_exists($key, $metadata)) {
                $metadata[$key] = $value;
            }
        }

        return $metadata;
    }

    private function filterUtm(array $utm): array
    {
        return collect($utm)->filter(fn ($value, $key) => str_starts_with(strtolower((string) $key), 'utm_')
                && is_scalar($value)
                && trim((string) $value) !== ''
                && ! preg_match('/\{\{\s*[^{}]+?\s*\}\}/u', (string) $value))
            ->map(fn ($value) => mb_substr((string) $value, 0, 500))->all();
    }

    private function mappingRowsToRules(array $rows): array
    {
        $rules = ['query' => [], 'utm' => []];
        foreach ($rows as $row) {
            $source = trim((string) ($row['field'] ?? ''));
            $target = trim((string) ($row['parameter'] ?? ''));
            $type = $row['type'] ?? 'get';
            if ($source === '' || $target === '') {
                continue;
            }
            if ($type === 'utm' && str_starts_with($target, 'utm_')) {
                $rules['utm'][$target] = '{{'.$source.'}}';
            } elseif ($type === 'get' && preg_match('/^[A-Za-z0-9_.-]{1,100}$/', $target)) {
                $rules['query'][$target] = '{{'.$source.'}}';
            }
        }

        return array_filter($rules);
    }

    /** Normalize static values and field references for GET/UTM redirects. */
    private function templateRules(array $values, string $kind): array
    {
        $rules = [$kind => []];
        foreach ($values as $parameter => $value) {
            if (is_array($value) && isset($value['from'])) {
                $rules[$kind][$parameter] = ['from' => (string) $value['from']];
            } elseif (is_scalar($value) && trim((string) $value) !== '') {
                // Static UTM values belong in utm_defaults; only dynamic UTM
                // templates need a tracking rule. GET values may be static.
                $isDynamic = preg_match('/\{\{\s*[^{}]+?\s*\}\}/u', (string) $value) === 1;
                if ($kind !== 'utm' || $isDynamic) {
                    $rules[$kind][$parameter] = (string) $value;
                }
            }
        }

        return array_filter($rules);
    }

    private function csvGetRules(array $record): array
    {
        $query = [];
        foreach ($record as $key => $value) {
            if (str_starts_with((string) $key, 'get_') && is_scalar($value) && trim((string) $value) !== '') {
                $query[substr((string) $key, 4)] = (string) $value;
            }
        }

        return $query === [] ? [] : ['query' => $query];
    }

    private function mergeTrackingRules(array ...$sets): array
    {
        $merged = ['query' => [], 'utm' => []];
        foreach ($sets as $set) {
            if (isset($set['query']) && is_array($set['query'])) {
                $merged['query'] = array_merge($merged['query'], $set['query']);
            }
            if (isset($set['get']) && is_array($set['get'])) {
                $merged['query'] = array_merge($merged['query'], $set['get']);
            }
            if (isset($set['utm']) && is_array($set['utm'])) {
                $merged['utm'] = array_merge($merged['utm'], $set['utm']);
            }
        }

        return array_filter($merged);
    }
}
