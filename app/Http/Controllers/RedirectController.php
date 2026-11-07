<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class RedirectController extends Controller
{
    public function __invoke(Request $request, string $code): RedirectResponse
    {
        $link = Link::query()->where('code', $code)->firstOrFail();

        abort_unless($link->isUsable(), 410);

        $metadata = $link->metadata ?? [];
        $rules = $link->tracking_rules ?? [];

        $incomingUtm = collect($request->query())
            ->filter(fn ($value, $key) => str_starts_with(strtolower((string) $key), 'utm_') && is_scalar($value))
            ->map(fn ($value) => mb_substr((string) $value, 0, 500))
            ->all();

        $defaultUtm = collect($metadata['utm_defaults'] ?? [])
            ->filter(fn ($value, $key) => str_starts_with(strtolower((string) $key), 'utm_') && is_scalar($value))
            ->map(fn ($value) => mb_substr((string) $value, 0, 500))
            ->all();

        $mappedUtm = $this->resolveMappedParameters($rules['utm'] ?? [], $metadata, true);
        $mappedGet = $this->resolveMappedParameters($rules['query'] ?? $rules['get'] ?? [], $metadata);

        // Explicit UTM values on the incoming short URL override configured values.
        $trackedUtm = array_merge($defaultUtm, $mappedUtm, $incomingUtm);
        $forwardedParameters = array_merge($mappedGet, $trackedUtm);
        $userAgent = (string) $request->userAgent();

        $link->increment('clicks');
        $link->clickLogs()->create([
            'ip_hash' => hash('sha256', $request->ip().config('app.key')),
            'user_agent' => mb_substr($userAgent, 0, 250),
            'referer' => mb_substr((string) $request->headers->get('referer'), 0, 2048) ?: null,
            'utm_parameters' => $trackedUtm ?: null,
            'device_type' => $this->deviceType($userAgent),
            'browser' => $this->browser($userAgent),
            'platform' => $this->platform($userAgent),
            'created_at' => Carbon::now(),
        ]);

        return redirect()->away($this->appendQueryParameters($link->original_url, $forwardedParameters), 302);
    }


    /** Resolve configured GET/UTM values from custom metadata. */
    private function resolveMappedParameters(array $mapping, array $metadata, bool $utmOnly = false): array
    {
        $resolved = [];

        foreach ($mapping as $parameter => $template) {
            $parameter = (string) $parameter;
            if (! preg_match('/^[A-Za-z0-9_.-]{1,100}$/', $parameter)) {
                continue;
            }
            if ($utmOnly && ! str_starts_with(strtolower($parameter), 'utm_')) {
                continue;
            }

            if (is_array($template) && isset($template['from'])) {
                $fieldName = (string) $template['from'];
                $value = array_key_exists($fieldName, $metadata) ? $metadata[$fieldName] : data_get($metadata, $fieldName);
            } elseif (is_string($template)) {
                $value = preg_replace_callback('/\{\{\s*([^{}]+?)\s*\}\}/u', function ($matches) use ($metadata) {
                    $fieldName = trim($matches[1]);
                    $field = array_key_exists($fieldName, $metadata) ? $metadata[$fieldName] : data_get($metadata, $fieldName);
                    return is_scalar($field) ? (string) $field : '';
                }, $template);

                if ($value === $template && array_key_exists($template, $metadata)) {
                    $value = $metadata[$template];
                }
            } else {
                $value = $template;
            }

            if (is_scalar($value) && trim((string) $value) !== '') {
                $resolved[$parameter] = mb_substr((string) $value, 0, 500);
            }
        }

        return $resolved;
    }

    /** Append query parameters while preserving the destination's existing query and fragment. */
    private function appendQueryParameters(string $url, array $utm): string
    {
        if ($utm === []) {
            return $url;
        }

        $parts = parse_url($url);
        if ($parts === false) {
            return $url;
        }

        parse_str($parts['query'] ?? '', $query);
        $query = array_merge($query, $utm);

        $base = ($parts['scheme'] ?? 'https').'://';
        if (isset($parts['user'])) {
            $base .= $parts['user'];
            if (isset($parts['pass'])) {
                $base .= ':'.$parts['pass'];
            }
            $base .= '@';
        }

        $host = $parts['host'] ?? '';
        $base .= str_contains($host, ':') && ! str_starts_with($host, '[') ? '['.$host.']' : $host;
        if (isset($parts['port'])) {
            $base .= ':'.$parts['port'];
        }
        $base .= $parts['path'] ?? '/';
        $result = $base.'?'.http_build_query($query, '', '&', PHP_QUERY_RFC3986);

        if (isset($parts['fragment'])) {
            $result .= '#'.$parts['fragment'];
        }

        return $result;
    }

    private function deviceType(string $userAgent): string
    {
        if (preg_match('/iPad|Tablet|PlayBook|Silk/i', $userAgent)) {
            return 'tablet';
        }

        return preg_match('/Mobile|Android|iPhone|iPod/i', $userAgent) ? 'mobile' : 'desktop';
    }

    private function browser(string $userAgent): string
    {
        return match (true) {
            preg_match('/Edg\//i', $userAgent) === 1 => 'Edge',
            preg_match('/OPR\//i', $userAgent) === 1 => 'Opera',
            preg_match('/Chrome\//i', $userAgent) === 1 => 'Chrome',
            preg_match('/Firefox\//i', $userAgent) === 1 => 'Firefox',
            preg_match('/Safari\//i', $userAgent) === 1 => 'Safari',
            default => 'Other',
        };
    }

    private function platform(string $userAgent): string
    {
        return match (true) {
            preg_match('/Windows/i', $userAgent) === 1 => 'Windows',
            preg_match('/Android/i', $userAgent) === 1 => 'Android',
            preg_match('/iPhone|iPad|iPod/i', $userAgent) === 1 => 'iOS',
            preg_match('/Mac OS X|Macintosh/i', $userAgent) === 1 => 'macOS',
            preg_match('/Linux/i', $userAgent) === 1 => 'Linux',
            default => 'Other',
        };
    }
}
