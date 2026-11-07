<?php

use App\Models\Link;
use App\Models\Team;
use App\Services\Links\LinkImportService;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Layout('layouts::app')] #[Title('ساخت گروهی و ورود و خروجی')] class extends Component
{
    use WithFileUploads;

    public string $folderName = '';
    public string $defaultUrl = '';
    public string $importContent = '';
    public $importFile = null;
    public array $mappingRows = [];
    public ?string $successMessage = null;

    private function currentTeam(): Team
    {
        $user = auth()->user();
        $team = $user?->currentTeam;
        abort_unless($user && $team && $user->belongsToTeam($team), 403);

        return $team;
    }

    public function addMapping(): void
    {
        $this->mappingRows[] = ['field' => '', 'type' => 'get', 'parameter' => ''];
    }

    public function removeMapping(int $index): void
    {
        unset($this->mappingRows[$index]);
        $this->mappingRows = array_values($this->mappingRows);
    }

    public function import(): void
    {
        $this->resetErrorBag();
        $this->validate([
            'folderName' => ['nullable', 'string', 'max:100'],
            'defaultUrl' => ['nullable', 'url:http,https', 'max:2048'],
            'importContent' => ['nullable', 'string', 'max:2000000'],
            'importFile' => ['nullable', 'file', 'extensions:csv,txt,json', 'max:10240'],
            'mappingRows' => ['array', 'max:30'],
            'mappingRows.*.field' => ['nullable', 'string', 'max:100'],
            'mappingRows.*.type' => ['required', 'in:get,utm'],
            'mappingRows.*.parameter' => ['nullable', 'string', 'max:100'],
        ]);

        $contents = trim($this->importContent);
        $format = 'json';
        if ($this->importFile) {
            $contents = file_get_contents($this->importFile->getRealPath()) ?: '';
            $extension = strtolower($this->importFile->getClientOriginalExtension());
            $preview = ltrim((string) $contents, "\xEF\xBB\xBF \t\n\r\0\x0B");
            $format = in_array($extension, ['csv', 'txt'], true)
                ? ((str_starts_with($preview, '{') || str_starts_with($preview, '[')) ? 'json' : 'csv')
                : 'json';
        } elseif ($contents !== '') {
            $preview = ltrim($contents, "\xEF\xBB\xBF \t\n\r\0\x0B");
            if (! str_starts_with($preview, '{') && ! str_starts_with($preview, '[')) {
                $format = 'csv';
            }
        }

        if (trim((string) $contents) === '') {
            $this->addError('importContent', 'یک فایل CSV/JSON بارگذاری کنید یا محتوای JSON را در کادر قرار دهید.');
            return;
        }

        $service = app(LinkImportService::class);
        $document = $service->parse((string) $contents, $format);
        if (trim($this->folderName) !== '' && empty($document['folder']) && empty($document['defaults']['folder'])) {
            $document['folder'] = trim($this->folderName);
        }
        if (trim($this->defaultUrl) !== '' && empty($document['destination_url']) && empty($document['defaults']['destination_url']) && empty($document['defaults']['url'])) {
            $document['destination_url'] = trim($this->defaultUrl);
        }

        $siteHost = strtolower(request()->getHost());
        $documentDefaults = is_array($document['defaults'] ?? null) ? $document['defaults'] : [];
        $recordsToCheck = $document['records'] ?? $document['links'] ?? [];
        foreach (is_array($recordsToCheck) ? $recordsToCheck : [] as $index => $record) {
            if (! is_array($record)) {
                continue;
            }
            $recordUrl = '';
            foreach (['url', 'destination_url', 'original_url'] as $urlKey) {
                if (is_scalar($record[$urlKey] ?? null) && trim((string) $record[$urlKey]) !== '') {
                    $recordUrl = trim((string) $record[$urlKey]);
                    break;
                }
            }
            $recordUrl = $recordUrl
                ?: (string) ($document['destination_url'] ?? $documentDefaults['destination_url'] ?? $documentDefaults['url'] ?? $this->defaultUrl);
            if (is_string($recordUrl) && filter_var($recordUrl, FILTER_VALIDATE_URL) && strtolower((string) parse_url($recordUrl, PHP_URL_HOST)) === $siteHost) {
                $this->addError('importContent', 'نشانی مقصد در ردیف '.($index + 1).' متعلق به همین سایت است و نمی‌تواند کوتاه شود.');
                return;
            }
        }

        $count = $service->import((int) $this->currentTeam()->id, (int) auth()->id(), $document, $this->mappingRows);
        $this->successMessage = number_format($count).' پیوند با موفقیت در گروه ساخته شد.';
        $this->reset('importContent', 'importFile', 'folderName', 'defaultUrl');
        $this->mappingRows = [];
    }

    public function exportJson()
    {
        $records = $this->exportRecords();
        $document = [
            'format' => 'peyvand-links',
            'version' => 1,
            'records' => $records,
        ];
        $json = json_encode($document, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);

        return response()->streamDownload(function () use ($json) {
            echo $json;
        }, 'peyvand-links-'.$this->currentTeam()->slug.'.json', ['Content-Type' => 'application/json; charset=UTF-8']);
    }

    public function exportCsv()
    {
        $records = $this->exportRecords();
        $metadataKeys = collect($records)->flatMap(fn ($record) => array_keys($record['metadata']))->unique()->sort()->values()->all();
        $reservedHeaders = [
            'url', 'custom_url', 'short_url', 'title', 'folder', 'category', 'tags', 'utm_source', 'utm_medium',
            'utm_campaign', 'utm_term', 'utm_content', 'tracking_json', 'expires_at', 'get', 'query', 'tracking',
        ];
        $metadataColumns = [];
        foreach ($metadataKeys as $key) {
            $header = in_array(strtolower((string) $key), $reservedHeaders, true)
                || str_starts_with(strtolower((string) $key), 'utm_')
                || str_starts_with(strtolower((string) $key), 'get_')
                ? 'meta_'.$key
                : (string) $key;
            while (in_array($header, $reservedHeaders, true) || in_array($header, $metadataColumns, true)) {
                $header = 'meta_'.$header;
            }
            $metadataColumns[$key] = $header;
        }
        $headers = array_merge([
            'url', 'custom_url', 'short_url', 'title', 'expires_at', 'folder', 'category', 'tags',
            'utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content', 'tracking_json',
        ], array_values($metadataColumns));

        return response()->streamDownload(function () use ($records, $headers, $metadataKeys, $metadataColumns) {
            $stream = fopen('php://output', 'w');
            fwrite($stream, "\xEF\xBB\xBF");
            fputcsv($stream, $headers);
            foreach ($records as $record) {
                $row = [
                    $record['url'],
                    $record['custom_url'],
                    $record['short_url'],
                    $record['title'],
                    $record['expires_at'],
                    $record['folder'],
                    $record['category'],
                    implode('|', $record['tags']),
                    $record['utm']['utm_source'] ?? '',
                    $record['utm']['utm_medium'] ?? '',
                    $record['utm']['utm_campaign'] ?? '',
                    $record['utm']['utm_term'] ?? '',
                    $record['utm']['utm_content'] ?? '',
                    json_encode($record['tracking'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?: '{}',
                ];
                foreach ($metadataKeys as $key) {
                    $value = $record['metadata'][$key] ?? '';
                    $row[] = is_scalar($value) ? $value : (json_encode($value, JSON_UNESCAPED_UNICODE) ?: '');
                }
                fputcsv($stream, $row);
            }
            fclose($stream);
        }, 'peyvand-links-'.$this->currentTeam()->slug.'.csv', ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    private function exportRecords(): array
    {
        return Link::query()
            ->forTeam((int) $this->currentTeam()->id)
            ->with(['folder:id,name', 'category:id,name', 'tags:id,name'])
            ->orderBy('id')
            ->get()
            ->map(function (Link $link) {
                $metadata = $link->metadata ?? [];
                $utm = $metadata['utm_defaults'] ?? [];
                unset($metadata['utm_defaults']);

                return [
                    'url' => $link->original_url,
                    'custom_url' => $link->code,
                    'short_url' => $link->short_url,
                    'title' => $link->title,
                    'expires_at' => $link->expires_at?->toISOString(),
                    'folder' => $link->folder?->name,
                    'category' => $link->category?->name,
                    'tags' => $link->tags->pluck('name')->all(),
                    'metadata' => $metadata,
                    'utm' => $utm,
                    'tracking' => $link->tracking_rules ?? [],
                ];
            })->all();
    }

    #[Computed]
    public function team(): Team
    {
        return $this->currentTeam();
    }

    #[Computed]
    public function linkCount(): int
    {
        return Link::query()->forTeam((int) $this->currentTeam()->id)->count();
    }
};
?>

<div class="mx-auto max-w-5xl space-y-6 p-6" dir="rtl">
    <div class="flex flex-wrap items-center justify-between gap-3">
        <div>
            <flux:heading size="xl">ساخت گروهی و ورود و خروجی داده</flux:heading>
            <flux:text class="mt-1">برای گروه {{ $this->team->name }}؛ هر سطر به یک پیوند عادی و مستقل تبدیل می‌شود.</flux:text>
        </div>
        <div class="flex gap-2">
            <flux:button href="{{ route('links.index') }}" variant="outline">بازگشت به پیوندها</flux:button>
            <flux:button href="{{ route('links.resources') }}" variant="outline">مدیریت منابع</flux:button>
        </div>
    </div>

    @if ($successMessage)
        <flux:callout color="green">{{ $successMessage }}</flux:callout>
    @endif

    <flux:card class="space-y-4">
        <div>
            <flux:heading size="lg">ساخت گروهی از CSV یا JSON</flux:heading>
            <flux:text size="sm" class="mt-1">فایل را از Excel به CSV UTF-8 تبدیل کنید یا خروجی JSON آماده‌شده توسط هوش مصنوعی را بارگذاری/جای‌گذاری کنید.</flux:text>
        </div>
        <form wire:submit="import" class="space-y-4">
            <div class="grid gap-3 md:grid-cols-2">
                <flux:input wire:model="folderName" label="پوشهٔ پیش‌فرض" placeholder="کمپین تبلیغاتی - پیامکی شماره ۷" />
                <flux:input wire:model="defaultUrl" label="نشانی مقصد پیش‌فرض (اختیاری)" placeholder="https://example.com/landing" dir="ltr" />
            </div>
            <flux:field>
                <flux:label>فایل داده</flux:label>
                <input type="file" wire:model="importFile" accept=".csv,.json,.txt" class="block w-full rounded-lg border border-zinc-300 p-3 text-sm dark:border-zinc-700" />
                <flux:description>CSV با سطر عنوان ستون‌ها یا فایل JSON. حداکثر اندازه: ۱۰ مگابایت.</flux:description>
                <flux:error name="importFile" />
            </flux:field>
            <div class="text-center text-xs text-zinc-500">یا JSON را مستقیماً اینجا جای‌گذاری کنید</div>
            <flux:textarea wire:model="importContent" rows="9" dir="ltr" class="font-mono text-xs" placeholder='{
  "folder": "کمپین تبلیغاتی - پیامکی شماره ۷",
  "records": [
    {
      "url": "https://example.com/offer",
      "title": "علی رضایی",
      "metadata": {"first_name": "علی", "last_name": "رضایی", "phone": "09120000000", "gender": "male"},
      "utm": {"utm_source": "sms", "utm_medium": "sms", "utm_content": "&#123;&#123;phone&#125;&#125;"},
      "get": {"phone": "&#123;&#123;phone&#125;&#125;", "gender": "&#123;&#123;gender&#125;&#125;"}
    }
  ]
}' />
            <flux:error name="importContent" />

            <flux:callout color="amber" icon="eye">
                هر فیلدی که به GET یا UTM نگاشت شود، در نشانی مقصد قرار می‌گیرد و ممکن است در نوار نشانی، تاریخچهٔ مرورگر و گزارش‌های سرور مقصد دیده شود. اطلاعات حساسی مانند شمارهٔ همراه را فقط در صورت نیاز و با مجوز مناسب ارسال کنید.
            </flux:callout>

            <div class="space-y-3 rounded-xl border border-zinc-200 p-3 dark:border-zinc-700">
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <div>
                        <flux:text class="font-medium">نگاشت ستون‌ها و فراداده</flux:text>
                        <flux:text size="xs" class="text-zinc-500">برای CSV مشخص کنید کدام فیلد به‌صورت GET یا UTM به نشانی مقصد فرستاده شود.</flux:text>
                    </div>
                    <flux:button type="button" size="sm" variant="outline" wire:click="addMapping">افزودن نگاشت</flux:button>
                </div>
                @foreach ($mappingRows as $index => $mapping)
                    <div class="grid gap-2 sm:grid-cols-[1fr_1fr_1fr_auto]" wire:key="mapping-{{ $index }}">
                        <flux:input wire:model="mappingRows.{{ $index }}.field" size="sm" placeholder="نام فیلد؛ مثل phone" dir="ltr" />
                        <flux:select wire:model="mappingRows.{{ $index }}.type" size="sm">
                            <flux:select.option value="get">پارامتر GET</flux:select.option>
                            <flux:select.option value="utm">پارامتر UTM</flux:select.option>
                        </flux:select>
                        <flux:input wire:model="mappingRows.{{ $index }}.parameter" size="sm" placeholder="نام پارامتر؛ مثل phone یا utm_content" dir="ltr" />
                        <flux:button type="button" size="sm" variant="ghost" icon="x-mark" wire:click="removeMapping({{ $index }})" />
                    </div>
                @endforeach
            </div>

            <div class="flex justify-end">
                <flux:button type="submit" variant="primary" wire:loading.attr="disabled" wire:target="import,importFile">ساخت پیوندها از داده‌ها</flux:button>
            </div>
        </form>
    </flux:card>

    <flux:card class="space-y-3">
        <div class="flex flex-wrap items-center justify-between gap-2">
            <div>
                <flux:heading size="lg">خروجی گروه</flux:heading>
                <flux:text size="sm">{{ number_format($this->linkCount) }} پیوند در گروه وجود دارد.</flux:text>
            </div>
            <div class="flex flex-wrap gap-2">
                <flux:button wire:click="exportCsv" icon="arrow-down-tray" variant="outline">دریافت CSV برای Excel</flux:button>
                <flux:button wire:click="exportJson" icon="code-bracket" variant="outline">دریافت JSON</flux:button>
            </div>
        </div>
        <flux:text size="sm" class="text-zinc-500">خروجی JSON تمام اطلاعات، فراداده‌ها، UTM و نگاشت GET را نگه می‌دارد. در CSV ستون‌های اضافی با پیشوند meta_ همان فراداده‌ها هستند.</flux:text>
    </flux:card>

    <flux:card class="space-y-2">
        <flux:heading size="lg">قواعد داده</flux:heading>
        <ul class="list-disc space-y-1 pr-5 text-sm text-zinc-600 dark:text-zinc-300">
            <li>هر رکورد یک پیوند مستقل در گروه جاری می‌سازد؛ هیچ موجودیت جداگانه‌ای برای پیامک یا کارزار ایجاد نمی‌شود.</li>
            <li>فیلدهای <code dir="ltr">url</code> یا <code dir="ltr">destination_url</code> نشانی مقصد هستند؛ <code dir="ltr">custom_url</code> یا <code dir="ltr">code</code> کد کوتاه دلخواه است.</li>
            <li>اگر کد کوتاه خالی باشد، کد تصادفی ساخته می‌شود. اگر پوشه وجود نداشته باشد، هنگام ورود داده ساخته خواهد شد.</li>
            <li>فیلدهای اضافی مانند <code dir="ltr">phone</code>، <code dir="ltr">gender</code>، <code dir="ltr">first_name</code> و <code dir="ltr">last_name</code> در فرادادهٔ JSON همان پیوند ذخیره می‌شوند.</li>
            <li>برای مقادیر پویا از الگوی <code dir="ltr">&#123;&#123;phone&#125;&#125;</code> استفاده کنید؛ مقدار از کلید <code dir="ltr">phone</code> در فراداده خوانده می‌شود.</li>
        </ul>
    </flux:card>
</div>
