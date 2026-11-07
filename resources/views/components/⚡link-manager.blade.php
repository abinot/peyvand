<?php

use App\Models\Link;
use App\Models\LinkClick;
use App\Models\Team;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts::app')] #[Title('مدیریت پیوندها')] class extends Component
{
    use WithPagination;

    public string $url = '';
    public string $title = '';
    public string $customCode = '';
    public ?string $expiresAt = null;
    public ?int $folderId = null;
    public ?int $categoryId = null;
    public array $tagIds = [];
    public array $metadataRows = [];
    public array $editMetadataRows = [];
    #[Locked]
    public array $editExtraTrackingRules = [];
    public string $utmSource = '';
    public string $utmMedium = '';
    public string $utmCampaign = '';
    public string $utmTerm = '';
    public string $utmContent = '';


    public string $search = '';
    public ?int $filterFolderId = null;
    public ?int $filterCategoryId = null;
    public ?int $filterTagId = null;

    public ?int $editingLinkId = null;
    public string $editingCode = '';
    public string $editUrl = '';
    public string $editTitle = '';
    public ?string $editExpiresAt = null;
    public ?int $editFolderId = null;
    public ?int $editCategoryId = null;
    public array $editTagIds = [];
    public string $editUtmSource = '';
    public string $editUtmMedium = '';
    public string $editUtmCampaign = '';
    public string $editUtmTerm = '';
    public string $editUtmContent = '';
    public bool $showEditModal = false;

    private function currentTeam(): Team
    {
        $user = auth()->user();
        $team = $user?->currentTeam;

        abort_unless($user && $team && $user->belongsToTeam($team), 403);

        return $team;
    }

    private function currentTeamId(): int
    {
        return (int) $this->currentTeam()->id;
    }

    private function teamLink(int $id): Link
    {
        return Link::query()
            ->forTeam($this->currentTeamId())
            ->findOrFail($id);
    }

    protected function rules(): array
    {
        $teamId = $this->currentTeamId();

        return [
            'url' => ['required', 'url:http,https', 'max:2048'],
            'title' => ['nullable', 'string', 'max:255'],
            'customCode' => [
                'nullable', 'alpha_dash:ascii', 'min:3', 'max:32',
                Rule::unique('links', 'code'),
                function (string $attribute, mixed $value, Closure $fail): void {
                    if (is_string($value) && in_array(strtolower($value), Link::RESERVED, true)) {
                        $fail('این کد برای مسیرهای داخلی سامانه رزرو شده است.');
                    }
                },
            ],
            'expiresAt' => ['nullable', 'date', 'after:now'],
            'folderId' => ['nullable', 'integer', Rule::exists('link_folders', 'id')->where('team_id', $teamId)],
            'categoryId' => ['nullable', 'integer', Rule::exists('link_categories', 'id')->where('team_id', $teamId)],
            'tagIds' => ['array', 'max:30'],
            'tagIds.*' => ['integer', Rule::exists('link_tags', 'id')->where('team_id', $teamId)],
            'metadataRows' => ['array', 'max:50'],
            'metadataRows.*.key' => ['nullable', 'string', 'max:100'],
            'metadataRows.*.value' => ['nullable', 'string', 'max:2000'],
            'metadataRows.*.mode' => ['nullable', 'in:store,get,utm'],
            'metadataRows.*.parameter' => ['nullable', 'string', 'max:100'],
            'utmSource' => ['nullable', 'string', 'max:255'],
            'utmMedium' => ['nullable', 'string', 'max:255'],
            'utmCampaign' => ['nullable', 'string', 'max:255'],
            'utmTerm' => ['nullable', 'string', 'max:255'],
            'utmContent' => ['nullable', 'string', 'max:255'],
        ];
    }

    private function editRules(): array
    {
        $teamId = $this->currentTeamId();

        return [
            'editUrl' => ['required', 'url:http,https', 'max:2048'],
            'editTitle' => ['nullable', 'string', 'max:255'],
            'editExpiresAt' => ['nullable', 'date'],
            'editFolderId' => ['nullable', 'integer', Rule::exists('link_folders', 'id')->where('team_id', $teamId)],
            'editCategoryId' => ['nullable', 'integer', Rule::exists('link_categories', 'id')->where('team_id', $teamId)],
            'editTagIds' => ['array', 'max:30'],
            'editTagIds.*' => ['integer', Rule::exists('link_tags', 'id')->where('team_id', $teamId)],
            'editMetadataRows' => ['array', 'max:50'],
            'editMetadataRows.*.key' => ['nullable', 'string', 'max:100'],
            'editMetadataRows.*.value' => ['nullable', 'string', 'max:2000'],
            'editMetadataRows.*.mode' => ['nullable', 'in:store,get,utm'],
            'editMetadataRows.*.parameter' => ['nullable', 'string', 'max:100'],
            'editUtmSource' => ['nullable', 'string', 'max:255'],
            'editUtmMedium' => ['nullable', 'string', 'max:255'],
            'editUtmCampaign' => ['nullable', 'string', 'max:255'],
            'editUtmTerm' => ['nullable', 'string', 'max:255'],
            'editUtmContent' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedFilterFolderId(): void
    {
        $this->resetPage();
    }

    public function updatedFilterCategoryId(): void
    {
        $this->resetPage();
    }

    public function updatedFilterTagId(): void
    {
        $this->resetPage();
    }

    public function create(): void
    {
        $data = $this->validate();

        if ($this->isOwnDomain($data['url'])) {
            $this->addError('url', 'نمی‌توانید نشانی همین سایت را کوتاه کنید.');
            return;
        }

        $metadataAndRules = $this->metadataAndRules($data['metadataRows'] ?? [], 'metadataRows');
        if ($metadataAndRules === null) {
            return;
        }
        $metadata = $metadataAndRules['metadata'];

        $metadata['utm_defaults'] = $this->utmDefaults([
            'utm_source' => $data['utmSource'] ?? '',
            'utm_medium' => $data['utmMedium'] ?? '',
            'utm_campaign' => $data['utmCampaign'] ?? '',
            'utm_term' => $data['utmTerm'] ?? '',
            'utm_content' => $data['utmContent'] ?? '',
        ]);
        if ($metadata['utm_defaults'] === []) {
            unset($metadata['utm_defaults']);
        }

        $user = auth()->user();
        $link = Link::create([
            'team_id' => $this->currentTeamId(),
            'created_by' => $user->id,
            'folder_id' => $data['folderId'] ?? null,
            'category_id' => $data['categoryId'] ?? null,
            'code' => $data['customCode'] ?: Link::generateCode(),
            'original_url' => $data['url'],
            'title' => $data['title'] ?: null,
            'expires_at' => $data['expiresAt'] ?: null,
            'metadata' => $metadata ?: null,
            'tracking_rules' => $metadataAndRules['tracking_rules'] ?: null,
        ]);

        $link->tags()->sync(array_map('intval', $data['tagIds'] ?? []));

        $this->reset(
            'url', 'title', 'customCode', 'expiresAt', 'folderId', 'categoryId',
            'tagIds', 'utmSource', 'utmMedium', 'utmCampaign', 'utmTerm', 'utmContent', 'metadataRows',
        );
        $this->metadataRows = [];
        $this->resetPage();
        $this->refreshLists();
        $this->dispatch('link-created');
    }

    public function edit(int $id): void
    {
        $link = $this->teamLink($id)->load(['folder', 'category', 'tags']);
        $metadata = $link->metadata ?? [];
        $utm = $metadata['utm_defaults'] ?? [];
        unset($metadata['utm_defaults']);

        $this->editingLinkId = $link->id;
        $this->editingCode = $link->code;
        $this->editUrl = $link->original_url;
        $this->editTitle = $link->title ?? '';
        $this->editExpiresAt = $link->expires_at?->format('Y-m-d\TH:i');
        $this->editFolderId = $link->folder_id;
        $this->editCategoryId = $link->category_id;
        $this->editTagIds = $link->tags->pluck('id')->map(fn ($id) => (string) $id)->all();
        $this->editMetadataRows = $this->metadataRowsForEditor($metadata, $link->tracking_rules ?? []);
        $this->editExtraTrackingRules = $this->complexTrackingRules($link->tracking_rules ?? [], $metadata);
        $this->editUtmSource = $utm['utm_source'] ?? '';
        $this->editUtmMedium = $utm['utm_medium'] ?? '';
        $this->editUtmCampaign = $utm['utm_campaign'] ?? '';
        $this->editUtmTerm = $utm['utm_term'] ?? '';
        $this->editUtmContent = $utm['utm_content'] ?? '';
        $this->showEditModal = true;
    }

    public function saveEdit(): void
    {
        $link = $this->teamLink((int) $this->editingLinkId);
        $data = $this->validate($this->editRules());

        if ($this->isOwnDomain($data['editUrl'])) {
            $this->addError('editUrl', 'نمی‌توانید نشانی همین سایت را به‌عنوان مقصد انتخاب کنید.');
            return;
        }

        $metadataAndRules = $this->metadataAndRules($data['editMetadataRows'] ?? [], 'editMetadataRows');
        if ($metadataAndRules === null) {
            return;
        }
        $metadata = $metadataAndRules['metadata'];

        $metadata['utm_defaults'] = $this->utmDefaults([
            'utm_source' => $data['editUtmSource'] ?? '',
            'utm_medium' => $data['editUtmMedium'] ?? '',
            'utm_campaign' => $data['editUtmCampaign'] ?? '',
            'utm_term' => $data['editUtmTerm'] ?? '',
            'utm_content' => $data['editUtmContent'] ?? '',
        ]);
        if ($metadata['utm_defaults'] === []) {
            unset($metadata['utm_defaults']);
        }

        $trackingRules = array_replace_recursive($this->editExtraTrackingRules, $metadataAndRules['tracking_rules']);
        $link->update([
            'folder_id' => $data['editFolderId'] ?? null,
            'category_id' => $data['editCategoryId'] ?? null,
            'original_url' => $data['editUrl'],
            'title' => $data['editTitle'] ?: null,
            'expires_at' => $data['editExpiresAt'] ?: null,
            'metadata' => $metadata ?: null,
            'tracking_rules' => $trackingRules ?: null,
        ]);
        $link->tags()->sync(array_map('intval', $data['editTagIds'] ?? []));

        $this->showEditModal = false;
        $this->reset(
            'editingLinkId', 'editingCode', 'editUrl', 'editTitle', 'editExpiresAt', 'editFolderId', 'editCategoryId',
            'editTagIds', 'editUtmSource', 'editUtmMedium', 'editUtmCampaign', 'editUtmTerm', 'editUtmContent', 'editMetadataRows', 'editExtraTrackingRules',
        );
        $this->editMetadataRows = [];
        $this->refreshLists();
        $this->dispatch('link-updated');
    }

    public function toggle(int $id): void
    {
        $link = $this->teamLink($id);
        $link->update(['is_active' => ! $link->is_active]);
        unset($this->links);
    }

    public function delete(int $id): void
    {
        $this->teamLink($id)->delete();
        $this->refreshLists();
    }

    private function isOwnDomain(string $url): bool
    {
        return strtolower((string) parse_url($url, PHP_URL_HOST)) === strtolower(request()->getHost());
    }

    public function addMetadataRow(string $target = 'create'): void
    {
        $property = $target === 'edit' ? 'editMetadataRows' : 'metadataRows';
        $this->{$property}[] = ['key' => '', 'value' => '', 'mode' => 'store', 'parameter' => ''];
    }

    public function removeMetadataRow(int $index, string $target = 'create'): void
    {
        $property = $target === 'edit' ? 'editMetadataRows' : 'metadataRows';
        unset($this->{$property}[$index]);
        $this->{$property} = array_values($this->{$property});
    }

    /** Convert key/value editor rows to the persisted JSON data and redirect mapping. */
    private function metadataAndRules(array $rows, string $errorField): ?array
    {
        $metadata = [];
        $rules = ['query' => [], 'utm' => []];

        foreach ($rows as $index => $row) {
            $key = trim((string) ($row['key'] ?? ''));
            $value = (string) ($row['value'] ?? '');
            if ($key === '' && trim($value) === '') {
                continue;
            }
            if ($key === '' || ! preg_match('/^[\pL\pN_. -]{1,100}$/u', $key) || strtolower($key) === 'utm_defaults') {
                $this->addError($errorField.'.'.$index.'.key', 'برای هر مقدار، یک کلید معتبر وارد کنید؛ نام utm_defaults رزرو شده است.');
                return null;
            }

            $metadata[$key] = $value;
            $mode = $row['mode'] ?? 'store';
            $parameter = trim((string) ($row['parameter'] ?? ''));

            if ($mode === 'get') {
                $parameter = $parameter !== '' ? $parameter : $key;
                if (! preg_match('/^[A-Za-z0-9_.-]{1,100}$/', $parameter)) {
                    $this->addError($errorField.'.'.$index.'.parameter', 'نام پارامتر GET معتبر نیست.');
                    return null;
                }
                $rules['query'][$parameter] = '{{'.$key.'}}';
            } elseif ($mode === 'utm') {
                if (! in_array($parameter, ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content'], true)) {
                    $this->addError($errorField.'.'.$index.'.parameter', 'یک پارامتر معتبر UTM انتخاب کنید.');
                    return null;
                }
                $rules['utm'][$parameter] = '{{'.$key.'}}';
            }
        }

        return [
            'metadata' => $metadata,
            'tracking_rules' => array_filter($rules),
        ];
    }

    /** Keep imported advanced templates that the simple key/value editor cannot represent. */
    private function complexTrackingRules(array $trackingRules, array $metadata): array
    {
        $extra = ['query' => [], 'utm' => []];
        foreach (['query', 'utm'] as $kind) {
            foreach (($trackingRules[$kind] ?? []) as $parameter => $template) {
                $isSimple = false;
                if (is_string($template) && preg_match('/^\{\{\s*([^{}]+?)\s*\}\}$/u', $template, $matches)) {
                    $isSimple = array_key_exists(trim($matches[1]), $metadata);
                } elseif (is_array($template) && isset($template['from'])) {
                    $isSimple = array_key_exists((string) $template['from'], $metadata);
                }
                if (! $isSimple) {
                    $extra[$kind][$parameter] = $template;
                }
            }
        }

        return array_filter($extra);
    }

    private function metadataRowsForEditor(array $metadata, array $trackingRules): array
    {
        $rows = [];
        foreach ($metadata as $key => $value) {
            $matched = false;
            foreach (($trackingRules['query'] ?? []) as $target => $template) {
                if ($template === '{{'.$key.'}}' || (is_array($template) && ($template['from'] ?? null) === $key)) {
                    $rows[] = [
                        'key' => (string) $key,
                        'value' => is_scalar($value) ? (string) $value : (json_encode($value, JSON_UNESCAPED_UNICODE) ?: ''),
                        'mode' => 'get',
                        'parameter' => (string) $target,
                    ];
                    $matched = true;
                }
            }
            foreach (($trackingRules['utm'] ?? []) as $target => $template) {
                if ($template === '{{'.$key.'}}' || (is_array($template) && ($template['from'] ?? null) === $key)) {
                    $rows[] = [
                        'key' => (string) $key,
                        'value' => is_scalar($value) ? (string) $value : (json_encode($value, JSON_UNESCAPED_UNICODE) ?: ''),
                        'mode' => 'utm',
                        'parameter' => (string) $target,
                    ];
                    $matched = true;
                }
            }
            if (! $matched) {
                $rows[] = [
                    'key' => (string) $key,
                    'value' => is_scalar($value) ? (string) $value : (json_encode($value, JSON_UNESCAPED_UNICODE) ?: ''),
                    'mode' => 'store',
                    'parameter' => '',
                ];
            }
        }

        return $rows;
    }

    private function utmDefaults(array $values): array
    {
        return collect($values)
            ->map(fn ($value) => trim((string) $value))
            ->filter(fn ($value) => $value !== '')
            ->all();
    }

    private function refreshLists(): void
    {
        unset($this->links, $this->summary, $this->folders, $this->categories, $this->tags);
    }

    #[Computed]
    public function team(): Team
    {
        return $this->currentTeam();
    }

    #[Computed]
    public function folders()
    {
        return $this->currentTeam()->folders()->orderBy('position')->orderBy('name')->get();
    }

    #[Computed]
    public function categories()
    {
        return $this->currentTeam()->categories()->orderBy('name')->get();
    }

    #[Computed]
    public function tags()
    {
        return $this->currentTeam()->tags()->orderBy('name')->get();
    }

    #[Computed]
    public function summary(): array
    {
        $teamId = $this->currentTeamId();
        $teamClicks = LinkClick::query()->whereHas('link', fn ($query) => $query->where('team_id', $teamId));

        return [
            'links' => Link::forTeam($teamId)->count(),
            'active' => Link::forTeam($teamId)->where('is_active', true)->count(),
            'clicks' => (clone $teamClicks)->count(),
            'visitors' => (clone $teamClicks)->whereNotNull('ip_hash')->distinct('ip_hash')->count('ip_hash'),
            'recent_clicks' => (clone $teamClicks)->where('created_at', '>=', now()->subDays(7))->count(),
        ];
    }

    #[Computed]
    public function links()
    {
        $teamId = $this->currentTeamId();

        return Link::query()
            ->forTeam($teamId)
            ->with(['folder:id,name', 'category:id,name', 'tags:id,name', 'creator:id,name'])
            ->withCount('clickLogs')
            ->when(trim($this->search) !== '', function ($query) {
                $term = '%'.addcslashes(trim($this->search), '%_\\').'%';
                $query->where(function ($query) use ($term) {
                    $query->where('code', 'like', $term)
                        ->orWhere('title', 'like', $term)
                        ->orWhere('original_url', 'like', $term);
                });
            })
            ->when($this->filterFolderId, fn ($query) => $query->where('folder_id', $this->filterFolderId))
            ->when($this->filterCategoryId, fn ($query) => $query->where('category_id', $this->filterCategoryId))
            ->when($this->filterTagId, fn ($query) => $query->whereHas('tags', fn ($tags) => $tags->where('link_tags.id', $this->filterTagId)->where('link_tags.team_id', $teamId)))
            ->latest()
            ->paginate(15);
    }
};
?>

<div class="mx-auto max-w-7xl space-y-6 p-6" dir="rtl">
    <div class="flex flex-wrap items-center justify-between gap-3">
        <div>
            <flux:heading size="xl">پیوندهای گروه {{ $this->team->name }}</flux:heading>
            <flux:text class="mt-1">پیوندها و آمار آن‌ها برای همهٔ اعضای این گروه در دسترس است؛ مالک هر رکورد خود گروه است.</flux:text>
        </div>
        <div class="flex flex-wrap gap-2">
            <flux:button href="{{ route('analytics.index') }}" variant="outline">گزارش آمار</flux:button>
            <flux:button href="{{ route('links.bulk') }}" variant="outline">ساخت گروهی و ورود داده</flux:button>
            <flux:button href="{{ route('links.resources') }}" variant="outline">مدیریت پوشه‌ها و برچسب‌ها</flux:button>
        </div>
    </div>

<div class="flex flex-wrap gap-3">
    <flux:card class="w-28 h-28 shrink-0 flex flex-col justify-between p-3">
        <flux:text size="sm">همهٔ پیوندها</flux:text>
        <flux:heading size="xl">{{ number_format($this->summary['links']) }}</flux:heading>
    </flux:card>

    <flux:card class="w-28 h-28 shrink-0 flex flex-col justify-between p-3">
        <flux:text size="sm">پیوندهای فعال</flux:text>
        <flux:heading size="xl">{{ number_format($this->summary['active']) }}</flux:heading>
    </flux:card>

    <flux:card class="w-28 h-28 shrink-0 flex flex-col justify-between p-3">
        <flux:text size="sm">همهٔ کلیک‌ها</flux:text>
        <flux:heading size="xl">{{ number_format($this->summary['clicks']) }}</flux:heading>
    </flux:card>

    <flux:card class="w-28 h-28 shrink-0 flex flex-col justify-between p-3">
        <flux:text size="sm">کلیک‌های ۷ روز اخیر</flux:text>
        <flux:heading size="xl">{{ number_format($this->summary['recent_clicks']) }}</flux:heading>
    </flux:card>

    <flux:card class="w-28 h-28 shrink-0 flex flex-col justify-between p-3">
        <flux:text size="sm">بازدیدکنندگان یکتا</flux:text>
        <flux:heading size="xl">{{ number_format($this->summary['visitors']) }}</flux:heading>
    </flux:card>
</div>

    <div class="grid gap-4 lg:grid-cols-2">
        <flux:card class="space-y-3">
            <flux:heading size="lg">ساخت پیوند کوتاه</flux:heading>
            <form wire:submit="create" class="space-y-4">
                <flux:input wire:model="url" label="نشانی مقصد" placeholder="https://example.com/page" dir="ltr" />
                <div class="grid gap-3 md:grid-cols-2">
                    <flux:input wire:model="title" label="عنوان (اختیاری)" />
                    <flux:input wire:model="customCode" label="کد دلخواه (اختیاری)" dir="ltr" />
                    <flux:input wire:model="expiresAt" type="datetime-local" label="زمان انقضا (اختیاری)" />
                    <flux:select wire:model="folderId" label="پوشه">
                        <flux:select.option value="">بدون پوشه</flux:select.option>
                        @foreach ($this->folders as $folder)
                            <flux:select.option value="{{ $folder->id }}">{{ $folder->name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:select wire:model="categoryId" label="دسته‌بندی">
                        <flux:select.option value="">بدون دسته‌بندی</flux:select.option>
                        @foreach ($this->categories as $category)
                            <flux:select.option value="{{ $category->id }}">{{ $category->name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    <div class="space-y-2 rounded-lg border border-zinc-200 p-3 dark:border-zinc-700">
                        <flux:text class="font-medium">برچسب‌ها</flux:text>
                        @forelse ($this->tags as $tag)
                            <label class="inline-flex items-center gap-2 pl-3 text-sm" wire:key="create-tag-{{ $tag->id }}">
                                <input type="checkbox" wire:model="tagIds" value="{{ $tag->id }}" class="rounded border-zinc-300" />
                                <span>{{ $tag->name }}</span>
                            </label>
                        @empty
                            <flux:text size="xs" class="text-zinc-500">ابتدا برچسب‌ها را در بخش مدیریت منابع بسازید.</flux:text>
                        @endforelse
                    </div>
                </div>

                <div class="space-y-3 rounded-xl border border-zinc-200 p-3 dark:border-zinc-700">
                    <flux:text class="font-medium">پارامترهای پیش‌فرض UTM</flux:text>
                    <div class="grid grid-cols-2 gap-2 sm:grid-cols-3">
                        <flux:input wire:model="utmSource" size="sm" placeholder="utm_source" />
                        <flux:input wire:model="utmMedium" size="sm" placeholder="utm_medium" />
                        <flux:input wire:model="utmCampaign" size="sm" placeholder="utm_campaign" />
                        <flux:input wire:model="utmTerm" size="sm" placeholder="utm_term" />
                        <flux:input wire:model="utmContent" size="sm" placeholder="utm_content" />
                    </div>
                </div>

                <div class="space-y-3 rounded-xl border border-zinc-200 p-3 dark:border-zinc-700">
                    <div class="flex items-center justify-between gap-2">
                        <div>
                            <flux:text class="font-medium">فرادادهٔ سفارشی</flux:text>
                            <flux:text size="xs" class="text-zinc-500">مقدارها در پایگاه داده به‌صورت JSON نگهداری می‌شوند. در اینجا فقط کلید و مقدار را وارد کنید.</flux:text>
                        </div>
                        <flux:button type="button" size="sm" variant="outline" wire:click="addMetadataRow">افزودن ردیف</flux:button>
                    </div>
                    @foreach ($metadataRows as $index => $row)
                        <div class="grid gap-2 rounded-lg bg-zinc-50 p-2 dark:bg-zinc-900 sm:grid-cols-[1fr_1.4fr_1fr_1fr_auto]" wire:key="metadata-create-{{ $index }}">
                            <flux:input wire:model="metadataRows.{{ $index }}.key" placeholder="کلید؛ مثل phone" size="sm" dir="ltr" />
                            <flux:input wire:model="metadataRows.{{ $index }}.value" placeholder="مقدار" size="sm" />
                            <flux:select wire:model="metadataRows.{{ $index }}.mode" size="sm">
                                <flux:select.option value="store">فقط ذخیره شود</flux:select.option>
                                <flux:select.option value="get">ارسال با GET</flux:select.option>
                                <flux:select.option value="utm">استفاده در UTM</flux:select.option>
                            </flux:select>
                            @if (($row['mode'] ?? 'store') === 'utm')
                                <flux:select wire:model="metadataRows.{{ $index }}.parameter" size="sm">
                                    <flux:select.option value="">پارامتر UTM</flux:select.option>
                                    <flux:select.option value="utm_source">utm_source</flux:select.option>
                                    <flux:select.option value="utm_medium">utm_medium</flux:select.option>
                                    <flux:select.option value="utm_campaign">utm_campaign</flux:select.option>
                                    <flux:select.option value="utm_term">utm_term</flux:select.option>
                                    <flux:select.option value="utm_content">utm_content</flux:select.option>
                                </flux:select>
                            @elseif (($row['mode'] ?? 'store') === 'get')
                                <flux:input wire:model="metadataRows.{{ $index }}.parameter" size="sm" placeholder="نام GET (اختیاری)" dir="ltr" />
                            @else
                                <div></div>
                            @endif
                            <flux:button type="button" size="sm" variant="ghost" icon="x-mark" wire:click="removeMetadataRow({{ $index }})" />
                        </div>
                    @endforeach
                    <flux:text size="xs" class="text-zinc-500">برای GET نام پارامتر دلخواه و برای UTM یکی از پارامترهای UTM را انتخاب کنید. برای فرستادن یک مقدار به چند مقصد، همان کلید را در چند ردیف به‌کار ببرید.</flux:text>
                    <flux:error name="metadataRows" />
                </div>

                <div class="flex justify-end"><flux:button type="submit" variant="primary">ساخت پیوند</flux:button></div>
            </form>
        </flux:card>

        <flux:card class="space-y-3">
            <flux:heading size="lg">فیلتر پیوندهای گروه</flux:heading>
            <flux:input wire:model.live.debounce.300ms="search" placeholder="جست‌وجو در عنوان، کد یا مقصد…" icon="magnifying-glass" />
            <div class="grid gap-3 sm:grid-cols-2">
                <flux:select wire:model.live="filterFolderId" label="پوشه">
                    <flux:select.option value="">همهٔ پوشه‌ها</flux:select.option>
                    @foreach ($this->folders as $folder)
                        <flux:select.option value="{{ $folder->id }}">{{ $folder->name }}</flux:select.option>
                    @endforeach
                </flux:select>
                <flux:select wire:model.live="filterCategoryId" label="دسته‌بندی">
                    <flux:select.option value="">همهٔ دسته‌ها</flux:select.option>
                    @foreach ($this->categories as $category)
                        <flux:select.option value="{{ $category->id }}">{{ $category->name }}</flux:select.option>
                    @endforeach
                </flux:select>
                <flux:select wire:model.live="filterTagId" label="برچسب">
                    <flux:select.option value="">همهٔ برچسب‌ها</flux:select.option>
                    @foreach ($this->tags as $tag)
                        <flux:select.option value="{{ $tag->id }}">{{ $tag->name }}</flux:select.option>
                    @endforeach
                </flux:select>
            </div>
            <div class="flex justify-end"><flux:button variant="ghost" wire:click="$set('search', '')">پاک‌کردن جست‌وجو</flux:button></div>
        </flux:card>



    </div>

    <flux:card class="space-y-4">
        <flux:heading size="lg">فهرست پیوندهای گروه</flux:heading>
        <flux:table :paginate="$this->links">
            <flux:table.columns>
                <flux:table.column>پیوند کوتاه</flux:table.column>
                <flux:table.column>عنوان و مقصد</flux:table.column>
                <flux:table.column>دسته‌بندی</flux:table.column>
                <flux:table.column align="end">کلیک‌ها</flux:table.column>
                <flux:table.column>وضعیت</flux:table.column>
                <flux:table.column>عملیات</flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @forelse ($this->links as $link)
                    <flux:table.row :key="$link->id">
                        <flux:table.cell>
                            <a href="{{ $link->short_url }}" target="_blank" rel="noopener noreferrer" class="font-medium underline" dir="ltr">{{ $link->short_url }}</a>
                            <div class="mt-1 text-xs text-zinc-500" dir="ltr">/{{ $link->code }}</div>
                        </flux:table.cell>
                        <flux:table.cell>
                            <div class="max-w-sm space-y-1">
                                <div class="font-medium">{{ $link->title ?: 'بدون عنوان' }}</div>
                                <div class="truncate text-xs text-zinc-500" dir="ltr" title="{{ $link->original_url }}">{{ $link->original_url }}</div>
                                <div class="flex flex-wrap gap-1 text-xs text-zinc-500">
                                    @if ($link->folder)<span>{{ $link->folder->name }}</span>@endif
                                    @foreach ($link->tags as $tag)<flux:badge size="sm">{{ $tag->name }}</flux:badge>@endforeach
                                </div>
                            </div>
                        </flux:table.cell>
                        <flux:table.cell>{{ $link->category?->name ?: '—' }}</flux:table.cell>
                        <flux:table.cell align="end">{{ number_format($link->click_logs_count) }}</flux:table.cell>
                        <flux:table.cell>
                            <flux:badge :color="$link->isUsable() ? 'green' : 'zinc'">{{ $link->isUsable() ? 'فعال' : 'غیرفعال / منقضی' }}</flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>
                            <div class="flex flex-wrap gap-1">
                                <flux:button size="sm" wire:click="edit({{ $link->id }})">ویرایش</flux:button>
                                <flux:button size="sm" x-data x-on:click="navigator.clipboard.writeText(@js($link->short_url))">کپی</flux:button>
                                <flux:button size="sm" wire:click="toggle({{ $link->id }})">{{ $link->is_active ? 'غیرفعال‌سازی' : 'فعال‌سازی' }}</flux:button>
                                <flux:button size="sm" variant="danger" wire:click="delete({{ $link->id }})" wire:confirm="این پیوند حذف شود؟">حذف</flux:button>
                            </div>
                            <div class="mt-1 text-xs text-zinc-500">سازنده: {{ $link->creator?->name ?? '—' }}</div>
                        </flux:table.cell>
                    </flux:table.row>
                @empty
                    <flux:table.row>
                        <flux:table.cell colspan="6" class="py-10 text-center text-zinc-500">پیوندی با این شرایط پیدا نشد.</flux:table.cell>
                    </flux:table.row>
                @endforelse
            </flux:table.rows>
        </flux:table>
    </flux:card>

    <flux:modal wire:model="showEditModal" class="md:w-[48rem]">
        <form wire:submit="saveEdit" class="space-y-4">
            <div>
                <flux:heading size="lg">ویرایش پیوند</flux:heading>
                <flux:text size="sm">کد کوتاه ثابت می‌ماند؛ مقصد و ویژگی‌های پیوند تغییر می‌کنند.</flux:text>
            </div>
            @if ($editingLinkId)
                <flux:field>
                    <flux:label>کد کوتاه (ثابت)</flux:label>
                    <flux:input :value="$editingCode" disabled dir="ltr" />
                </flux:field>
            @endif
            <flux:input wire:model="editTitle" label="عنوان" />
            <flux:input wire:model="editUrl" label="نشانی مقصد جدید" dir="ltr" />
            <div class="grid gap-3 sm:grid-cols-2">
                <flux:input wire:model="editExpiresAt" type="datetime-local" label="زمان انقضا" />
                <flux:select wire:model="editFolderId" label="پوشه">
                    <flux:select.option value="">بدون پوشه</flux:select.option>
                    @foreach ($this->folders as $folder)
                        <flux:select.option value="{{ $folder->id }}">{{ $folder->name }}</flux:select.option>
                    @endforeach
                </flux:select>
                <flux:select wire:model="editCategoryId" label="دسته‌بندی">
                    <flux:select.option value="">بدون دسته‌بندی</flux:select.option>
                    @foreach ($this->categories as $category)
                        <flux:select.option value="{{ $category->id }}">{{ $category->name }}</flux:select.option>
                    @endforeach
                </flux:select>
                <div class="space-y-2 rounded-lg border border-zinc-200 p-3 dark:border-zinc-700">
                    <flux:text class="font-medium">برچسب‌ها</flux:text>
                    @forelse ($this->tags as $tag)
                        <label class="inline-flex items-center gap-2 pl-3 text-sm" wire:key="edit-tag-{{ $tag->id }}">
                            <input type="checkbox" wire:model="editTagIds" value="{{ $tag->id }}" class="rounded border-zinc-300" />
                            <span>{{ $tag->name }}</span>
                        </label>
                    @empty
                        <flux:text size="xs" class="text-zinc-500">برچسبی برای انتخاب وجود ندارد.</flux:text>
                    @endforelse
                </div>
            </div>
            <div class="rounded-xl border border-zinc-200 p-3 dark:border-zinc-700">
                <flux:text class="mb-2 font-medium">پارامترهای پیش‌فرض UTM</flux:text>
                <div class="grid gap-2 sm:grid-cols-2">
                    <flux:input wire:model="editUtmSource" size="sm" placeholder="utm_source" />
                    <flux:input wire:model="editUtmMedium" size="sm" placeholder="utm_medium" />
                    <flux:input wire:model="editUtmCampaign" size="sm" placeholder="utm_campaign" />
                    <flux:input wire:model="editUtmTerm" size="sm" placeholder="utm_term" />
                    <flux:input wire:model="editUtmContent" size="sm" placeholder="utm_content" />
                </div>
            </div>
            <div class="space-y-3 rounded-xl border border-zinc-200 p-3 dark:border-zinc-700">
                <div class="flex items-center justify-between gap-2">
                    <flux:text class="font-medium">فرادادهٔ سفارشی</flux:text>
                    <flux:button type="button" size="sm" variant="outline" wire:click="addMetadataRow('edit')">افزودن ردیف</flux:button>
                </div>
                @foreach ($editMetadataRows as $index => $row)
                    <div class="grid gap-2 rounded-lg bg-zinc-50 p-2 dark:bg-zinc-900 sm:grid-cols-[1fr_1.4fr_1fr_1fr_auto]" wire:key="metadata-edit-{{ $index }}">
                        <flux:input wire:model="editMetadataRows.{{ $index }}.key" placeholder="کلید" size="sm" dir="ltr" />
                        <flux:input wire:model="editMetadataRows.{{ $index }}.value" placeholder="مقدار" size="sm" />
                        <flux:select wire:model="editMetadataRows.{{ $index }}.mode" size="sm">
                            <flux:select.option value="store">فقط ذخیره شود</flux:select.option>
                            <flux:select.option value="get">ارسال با GET</flux:select.option>
                            <flux:select.option value="utm">استفاده در UTM</flux:select.option>
                        </flux:select>
                        @if (($row['mode'] ?? 'store') === 'utm')
                            <flux:select wire:model="editMetadataRows.{{ $index }}.parameter" size="sm">
                                <flux:select.option value="">پارامتر UTM</flux:select.option>
                                <flux:select.option value="utm_source">utm_source</flux:select.option>
                                <flux:select.option value="utm_medium">utm_medium</flux:select.option>
                                <flux:select.option value="utm_campaign">utm_campaign</flux:select.option>
                                <flux:select.option value="utm_term">utm_term</flux:select.option>
                                <flux:select.option value="utm_content">utm_content</flux:select.option>
                            </flux:select>
                        @elseif (($row['mode'] ?? 'store') === 'get')
                            <flux:input wire:model="editMetadataRows.{{ $index }}.parameter" placeholder="نام GET (اختیاری)" size="sm" dir="ltr" />
                        @else
                            <div></div>
                        @endif
                        <flux:button type="button" size="sm" variant="ghost" icon="x-mark" wire:click="removeMetadataRow({{ $index }}, 'edit')" />
                    </div>
                @endforeach
                <flux:text size="xs" class="text-zinc-500">فراداده در پایگاه داده به‌صورت JSON ذخیره می‌شود؛ لازم نیست خود JSON را ویرایش کنید.</flux:text>
                <flux:error name="editMetadataRows" />
            </div>
            <div class="flex justify-end gap-2">
                <flux:modal.close><flux:button type="button" variant="ghost">انصراف</flux:button></flux:modal.close>
                <flux:button type="submit" variant="primary">ذخیره تغییرات</flux:button>
            </div>
        </form>
    </flux:modal>
</div>
