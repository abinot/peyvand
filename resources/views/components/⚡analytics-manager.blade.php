<?php

use App\Models\Link;
use App\Models\LinkClick;
use App\Models\Team;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::app')] #[Title('آمار پیوندها')] class extends Component
{
    private function currentTeam(): Team
    {
        $user = auth()->user();
        $team = $user?->currentTeam;

        abort_unless(
            $user && $team && $user->belongsToTeam($team),
            403
        );

        return $team;
    }

    #[Computed]
    public function team(): Team
    {
        return $this->currentTeam();
    }

    #[Computed]
    public function report(): array
    {
        $teamId = (int) $this->currentTeam()->id;
        $now = now();

        /*
        |--------------------------------------------------------------------------
        | Team clicks
        |--------------------------------------------------------------------------
        */

        $teamClicks = LinkClick::query()
            ->whereHas('link', fn ($query) => $query
                ->where('team_id', $teamId)
            );

        $totalClicks = (clone $teamClicks)->count();

        $clicks24h = (clone $teamClicks)
            ->where('created_at', '>=', $now->copy()->subDay())
            ->count();

        $uniqueVisitors = (clone $teamClicks)
            ->whereNotNull('ip_hash')
            ->distinct()
            ->count('ip_hash');

        /*
        |--------------------------------------------------------------------------
        | Recent clicks
        |--------------------------------------------------------------------------
        */

        $clicks = (clone $teamClicks)
            ->with('link:id,code,title')
            ->latest('created_at')
            ->limit(5000)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Daily statistics
        |--------------------------------------------------------------------------
        */

        $startDate = $now->copy()->subDays(13)->startOfDay();

        $dailyRows = (clone $teamClicks)
            ->where('link_clicks.created_at', '>=', $startDate)
            ->selectRaw('DATE(link_clicks.created_at) as day, COUNT(*) as clicks')
            ->groupBy(DB::raw('DATE(link_clicks.created_at)'))
            ->orderBy('day')
            ->get()
            ->keyBy('day');

        $daily = collect(range(13, 0))
            ->map(function (int $daysAgo) use ($dailyRows, $now) {
                $date = $now->copy()->subDays($daysAgo);
                $dayKey = $date->toDateString();

                return [
                    'day' => $dayKey,
                    'label' => $date->format('m/d'),
                    'clicks' => (int) (
                        $dailyRows->get($dayKey)?->clicks ?? 0
                    ),
                ];
            })
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Grouped chart: clicks per link per day
        |--------------------------------------------------------------------------
        */

        $chartLinks = Link::query()
            ->forTeam($teamId)
            ->withCount([
                'clickLogs as recent_clicks_count' => fn ($query) => $query
                    ->where('created_at', '>=', $startDate),
            ])
            ->orderByDesc('recent_clicks_count')
            ->limit(8)
            ->get()
            ->filter(fn ($link) => (int) $link->recent_clicks_count > 0)
            ->values();

        $chartLinkIds = $chartLinks->pluck('id');

        $dailyLinkRows = $chartLinkIds->isEmpty()
            ? collect()
            : LinkClick::query()
                ->whereIn('link_id', $chartLinkIds)
                ->where('created_at', '>=', $startDate)
                ->selectRaw(
                    'link_id, DATE(created_at) as day, COUNT(*) as clicks'
                )
                ->groupBy('link_id', DB::raw('DATE(created_at)'))
                ->get();

        $chartColors = [
            '#3B82F6',
            '#10B981',
            '#F59E0B',
            '#EF4444',
            '#8B5CF6',
            '#06B6D4',
            '#F97316',
            '#EC4899',
        ];

        $datasets = $chartLinks
            ->values()
            ->map(function ($link, $index) use (
                $dailyLinkRows,
                $daily,
                $chartColors
            ) {
                $rows = $dailyLinkRows
                    ->where('link_id', $link->id)
                    ->keyBy('day');

                $color = $chartColors[$index % count($chartColors)];

                return [
                    'label' => $link->title ?: '/'.$link->code,

                    'data' => $daily
                        ->map(fn ($day) => (int) (
                            $rows->get($day['day'])?->clicks ?? 0
                        ))
                        ->values()
                        ->all(),

                    'backgroundColor' => $color,
                    'borderColor' => $color,
                    'borderWidth' => 1,
                    'borderRadius' => 4,
                ];
            })
            ->values()
            ->all();

        $chart = [
            'labels' => $daily->pluck('label')->values()->all(),
            'datasets' => $datasets,
        ];

        /*
        |--------------------------------------------------------------------------
        | Top links
        |--------------------------------------------------------------------------
        */

        $topLinks = Link::query()
            ->forTeam($teamId)
            ->withCount('clickLogs')
            ->orderByDesc('click_logs_count')
            ->limit(10)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Grouped statistics
        |--------------------------------------------------------------------------
        */

        $groupCounts = static function ($values) {
            return collect($values)
                ->map(fn ($value) => filled($value)
                    ? trim((string) $value)
                    : 'نامشخص'
                )
                ->countBy()
                ->sortDesc()
                ->take(8)
                ->map(fn ($count, $name) => [
                    'name' => $name,
                    'count' => $count,
                ])
                ->values();
        };

        $utmSources = $groupCounts(
            $clicks->map(
                fn ($click) => data_get(
                    $click->utm_parameters,
                    'utm_source'
                ) ?: 'بدون UTM'
            )
        );

        $devices = $groupCounts(
            $clicks->pluck('device_type')
        );

        $browsers = $groupCounts(
            $clicks->pluck('browser')
        );

        $referrers = $groupCounts(
            $clicks->map(function ($click) {
                $host = $click->referer
                    ? parse_url($click->referer, PHP_URL_HOST)
                    : null;

                return $host ?: 'ورود مستقیم / نامشخص';
            })
        );

        /*
        |--------------------------------------------------------------------------
        | Return report
        |--------------------------------------------------------------------------
        */

        return [
            'links' => Link::forTeam($teamId)->count(),

            'clicks' => $totalClicks,

            'clicks_24h' => $clicks24h,

            'unique_visitors' => $uniqueVisitors,

            'daily' => $daily,

            'chart' => $chart,

            'top_links' => $topLinks,

            'utm_sources' => $utmSources,

            'devices' => $devices,

            'browsers' => $browsers,

            'referrers' => $referrers,

            'sample_size' => $clicks->count(),
        ];
    }
};
?>

<div class="mx-auto max-w-7xl space-y-6 p-4 sm:p-6" dir="rtl">

    @script
    <script>
        Alpine.data('teamGroupedBarChart', () => ({
            chart: null,

            init() {
                const chartData = @js($this->report['chart']);

                if (!window.PeyvandCharts) {
                    console.error(
                        'PeyvandCharts بارگذاری نشده است. تنظیمات Chart.js را بررسی کنید.'
                    );

                    return;
                }

                this.chart = window.PeyvandCharts.createGroupedBarChart(
                    this.$refs.canvas,
                    chartData
                );
            },

            destroy() {
                this.chart?.destroy();
                this.chart = null;
            },
        }));
    </script>
    @endscript

    {{-- Header --}}
    <section class="flex flex-wrap items-center justify-between gap-4">

        <div class="space-y-1">

            <div class="flex flex-wrap items-center gap-2">
                <flux:heading size="xl">
                    گزارش آمار
                </flux:heading>

                <flux:badge color="blue">
                    {{ $this->team->name }}
                </flux:badge>
            </div>

            <flux:text>
                بررسی عملکرد پیوندها و رفتار بازدیدکنندگان گروه
            </flux:text>

        </div>

        <flux:button
            href="{{ route('links.index') }}"
            variant="outline"
            icon="arrow-right"
        >
            بازگشت به پیوندها
        </flux:button>

    </section>

    {{-- Summary --}}
    <section class="space-y-3">

        <div class="flex items-center justify-between">
            <flux:heading size="lg">
                نمای کلی
            </flux:heading>

            <flux:badge color="zinc">
                آمار کلی
            </flux:badge>
        </div>

        <div class="flex flex-wrap gap-3">

            @foreach ([
                [
                    'title' => 'پیوندها',
                    'value' => $this->report['links'],
                ],
                [
                    'title' => 'همهٔ کلیک‌ها',
                    'value' => $this->report['clicks'],
                ],
                [
                    'title' => 'کلیک در ۲۴ ساعت',
                    'value' => $this->report['clicks_24h'],
                ],
                [
                    'title' => 'بازدیدکنندگان یکتا',
                    'value' => $this->report['unique_visitors'],
                ],
            ] as $stat)

                <flux:card
                    class="flex h-28 w-28 shrink-0 flex-col justify-between p-3"
                >
                    <flux:text size="sm">
                        {{ $stat['title'] }}
                    </flux:text>

                    <flux:heading
                        size="xl"
                        class="tabular-nums"
                    >
                        {{ number_format($stat['value']) }}
                    </flux:heading>
                </flux:card>

            @endforeach

        </div>

    </section>

    {{-- Daily grouped chart --}}
    <section>

        <flux:card class="space-y-5">

            <div class="flex flex-wrap items-start justify-between gap-3">

                <div>
                    <flux:heading size="lg">
                        عملکرد روزانهٔ پیوندها
                    </flux:heading>

                    <flux:text class="mt-1">
                        مقایسهٔ تعداد کلیک هر پیوند در ۱۴ روز گذشته
                    </flux:text>
                </div>

                <flux:badge color="blue">
                    ۱۴ روز اخیر
                </flux:badge>

            </div>

            @if (count($this->report['chart']['datasets']) > 0)

                <div
                    wire:ignore
                    x-data="teamGroupedBarChart"
                    class="relative h-80 w-full min-w-0 sm:h-96"
                >
                    <canvas
                        x-ref="canvas"
                        role="img"
                        aria-label="نمودار میله‌ای گروهی تعداد کلیک پیوندها"
                    ></canvas>
                </div>

                <div class="flex flex-wrap gap-x-4 gap-y-2">
                    @foreach ($this->report['chart']['datasets'] as $dataset)
                        <div
                            wire:key="chart-legend-{{ $loop->index }}"
                            class="flex items-center gap-2"
                        >
                            <span
                                class="size-3 shrink-0 rounded-sm"
                                style="background-color: {{ $dataset['backgroundColor'] }}"
                            ></span>

                            <flux:text size="sm">
                                {{ $dataset['label'] }}
                            </flux:text>
                        </div>
                    @endforeach
                </div>

            @else

                <div class="flex min-h-64 items-center justify-center">
                    <div class="space-y-2 text-center">

                        <flux:icon.chart-bar
                            class="mx-auto size-10 text-zinc-400"
                        />

                        <flux:heading size="sm">
                            هنوز داده‌ای برای نمودار وجود ندارد
                        </flux:heading>

                        <flux:text size="sm">
                            پس از ثبت کلیک روی پیوندها، نمودار نمایش داده می‌شود.
                        </flux:text>

                    </div>
                </div>

            @endif

        </flux:card>

    </section>

    {{-- Top links --}}
    <section>

        <flux:card class="space-y-4">

            <div class="flex flex-wrap items-center justify-between gap-3">

                <div>
                    <flux:heading size="lg">
                        پیوندهای پربازدید
                    </flux:heading>

                    <flux:text class="mt-1">
                        ۱۰ پیوند با بیشترین تعداد کلیک
                    </flux:text>
                </div>

                <flux:badge color="blue">
                    ۱۰ پیوند برتر
                </flux:badge>

            </div>

            <div class="overflow-x-auto">

                <flux:table>

                    <flux:table.columns>
                        <flux:table.column>
                            پیوند
                        </flux:table.column>

                        <flux:table.column>
                            عنوان
                        </flux:table.column>

                        <flux:table.column align="end">
                            تعداد کلیک
                        </flux:table.column>
                    </flux:table.columns>

                    <flux:table.rows>

                        @forelse ($this->report['top_links'] as $link)

                            <flux:table.row :key="$link->id">

                                <flux:table.cell>
                                    <a
                                        href="{{ $link->short_url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        dir="ltr"
                                        class="font-medium text-blue-600 underline dark:text-blue-400"
                                    >
                                        /{{ $link->code }}
                                    </a>
                                </flux:table.cell>

                                <flux:table.cell>
                                    {{ $link->title ?: 'بدون عنوان' }}
                                </flux:table.cell>

                                <flux:table.cell align="end">
                                    <flux:badge color="blue">
                                        {{ number_format($link->click_logs_count) }}
                                    </flux:badge>
                                </flux:table.cell>

                            </flux:table.row>

                        @empty

                            <flux:table.row>
                                <flux:table.cell
                                    colspan="3"
                                    class="py-8 text-center"
                                >
                                    <flux:text>
                                        هنوز پیوندی برای نمایش وجود ندارد.
                                    </flux:text>
                                </flux:table.cell>
                            </flux:table.row>

                        @endforelse

                    </flux:table.rows>

                </flux:table>

            </div>

        </flux:card>

    </section>

    {{-- Breakdown --}}
    <section class="space-y-4">

        <div>
            <flux:heading size="lg">
                جزئیات بازدیدها
            </flux:heading>

            <flux:text class="mt-1">
                بررسی منابع ورودی و مشخصات بازدیدکنندگان
            </flux:text>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">

            @foreach ([
                [
                    'title' => 'منابع UTM',
                    'description' => 'منبع ورود بازدیدکنندگان',
                    'items' => 'utm_sources',
                ],
                [
                    'title' => 'نوع دستگاه',
                    'description' => 'دستگاه مورد استفادهٔ بازدیدکنندگان',
                    'items' => 'devices',
                ],
                [
                    'title' => 'مرورگر',
                    'description' => 'مرورگرهای استفاده‌شده',
                    'items' => 'browsers',
                ],
                [
                    'title' => 'ارجاع‌دهنده‌ها',
                    'description' => 'وب‌سایت‌های هدایت‌کنندهٔ بازدیدکنندگان',
                    'items' => 'referrers',
                ],
            ] as $group)

                @php
                    $items = $this->report[$group['items']];
                    $maxCount = max(1, (int) $items->max('count'));
                @endphp

                <flux:card class="space-y-4">

                    <div>
                        <flux:heading size="lg">
                            {{ $group['title'] }}
                        </flux:heading>

                        <flux:text size="sm" class="mt-1">
                            {{ $group['description'] }}
                        </flux:text>
                    </div>

                    @forelse ($items as $item)

                        <div
                            wire:key="{{ $group['items'] }}-{{ $loop->index }}"
                            class="space-y-2"
                        >

                            <div class="flex items-center justify-between gap-3">

                                <flux:text class="min-w-0 truncate">
                                    {{ $item['name'] }}
                                </flux:text>

                                <flux:badge>
                                    {{ number_format($item['count']) }}
                                </flux:badge>

                            </div>

                            <div class="h-2 overflow-hidden rounded-full bg-zinc-100 dark:bg-zinc-800">

                                <div
                                    class="h-full rounded-full bg-blue-500 transition-all"
                                    style="width: {{ ($item['count'] / $maxCount) * 100 }}%"
                                ></div>

                            </div>

                        </div>

                    @empty

                        <div class="py-6 text-center">
                            <flux:text class="text-zinc-500">
                                داده‌ای برای نمایش وجود ندارد.
                            </flux:text>
                        </div>

                    @endforelse

                </flux:card>

            @endforeach

        </div>

    </section>

    {{-- Privacy note --}}
    <flux:card
        size="sm"
        variant="soft"
        class="space-y-2"
    >

        <div class="flex items-center gap-2">

            <flux:icon.shield-check
                variant="outline"
                class="size-5 text-zinc-500"
            />

            <flux:heading size="sm">
                حریم خصوصی و دقت آمار
            </flux:heading>

        </div>

        <flux:text size="sm">
            نشانی IP خام ذخیره نمی‌شود. تعداد بازدیدکنندگان یکتا بر اساس هش IP
            محاسبه شده و تخمینی است؛ بنابراین لزوماً با تعداد افراد واقعی برابر نیست.
        </flux:text>

        <flux:text size="xs" class="text-zinc-500">
            جزئیات منابع، دستگاه‌ها، مرورگرها و ارجاع‌دهنده‌ها بر اساس
            حداکثر {{ number_format($this->report['sample_size']) }}
            کلیک اخیر محاسبه شده‌اند.
        </flux:text>

    </flux:card>

</div>