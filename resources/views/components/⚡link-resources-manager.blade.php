<?php

use App\Models\LinkCategory;
use App\Models\LinkFolder;
use App\Models\LinkTag;
use App\Models\Team;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::app')] #[Title('مدیریت منابع پیوند')] class extends Component
{
    public string $newType = 'folder';
    public string $newName = '';
    public ?int $editingId = null;
    public string $editingType = 'folder';
    public string $editingName = '';
    public bool $showEditModal = false;

    private function currentTeam(): Team
    {
        $user = auth()->user();
        $team = $user?->currentTeam;
        abort_unless($user && $team && $user->belongsToTeam($team), 403);

        return $team;
    }

    public function create(): void
    {
        $data = $this->validate([
            'newType' => ['required', 'in:folder,category,tag'],
            'newName' => ['required', 'string', 'max:100'],
        ]);

        $name = trim($data['newName']);
        $team = $this->currentTeam();

        if ($data['newType'] === 'folder') {
            $team->folders()->firstOrCreate(['name' => $name]);
        } else {
            $slug = $this->makeSlug($name, $data['newType']);
            $relation = $data['newType'] === 'category' ? $team->categories() : $team->tags();
            $relation->firstOrCreate(['slug' => $slug], ['name' => $name]);
        }

        $this->reset('newName');
        unset($this->folders, $this->categories, $this->tags);
        $this->dispatch('resource-created');
    }

    public function edit(string $type, int $id): void
    {
        $resource = $this->findResource($type, $id);
        $this->editingType = $type;
        $this->editingId = $id;
        $this->editingName = $resource->name;
        $this->showEditModal = true;
    }

    public function update(): void
    {
        $rules = [
            'editingType' => ['required', 'in:folder,category,tag'],
            'editingId' => ['required', 'integer'],
            'editingName' => ['required', 'string', 'max:100'],
        ];
        if ($this->editingType === 'folder' && $this->editingId) {
            $rules['editingName'][] = Rule::unique('link_folders', 'name')
                ->where('team_id', $this->currentTeam()->id)
                ->ignore($this->editingId);
        }
        $data = $this->validate($rules);

        $resource = $this->findResource($data['editingType'], $data['editingId']);
        $name = trim($data['editingName']);
        if ($data['editingType'] === 'folder') {
            $resource->update(['name' => $name]);
        } else {
            $resource->update([
                'name' => $name,
                'slug' => $this->makeSlug($name, $data['editingType'], $resource->id),
            ]);
        }

        $this->showEditModal = false;
        $this->reset('editingId', 'editingName');
        unset($this->folders, $this->categories, $this->tags);
    }

    public function delete(string $type, int $id): void
    {
        $this->findResource($type, $id)->delete();
        unset($this->folders, $this->categories, $this->tags);
    }

    private function findResource(string $type, int $id): LinkFolder|LinkCategory|LinkTag
    {
        $team = $this->currentTeam();

        return match ($type) {
            'folder' => $team->folders()->findOrFail($id),
            'category' => $team->categories()->findOrFail($id),
            'tag' => $team->tags()->findOrFail($id),
            default => abort(404),
        };
    }

    private function makeSlug(string $name, string $type, ?int $ignoreId = null): string
    {
        $base = Str::slug($name) ?: $type.'-'.substr(sha1(mb_strtolower($name)), 0, 10);
        $slug = $base;
        $suffix = 2;
        $relation = $type === 'category' ? $this->currentTeam()->categories() : $this->currentTeam()->tags();

        while ($relation->where('slug', $slug)->when($ignoreId, fn ($query) => $query->where('id', '<>', $ignoreId))->exists()) {
            $slug = $base.'-'.$suffix++;
        }

        return $slug;
    }

    #[Computed]
    public function team(): Team
    {
        return $this->currentTeam();
    }

    #[Computed]
    public function folders()
    {
        return $this->currentTeam()->folders()->withCount('links')->orderBy('position')->orderBy('name')->get();
    }

    #[Computed]
    public function categories()
    {
        return $this->currentTeam()->categories()->withCount('links')->orderBy('name')->get();
    }

    #[Computed]
    public function tags()
    {
        return $this->currentTeam()->tags()->withCount('links')->orderBy('name')->get();
    }
};
?>

<div class="mx-auto max-w-6xl space-y-6 p-6" dir="rtl">
    <div class="flex flex-wrap items-center justify-between gap-3">
        <div>
            <flux:heading size="xl">مدیریت پوشه‌ها، دسته‌بندی‌ها و برچسب‌ها</flux:heading>
            <flux:text class="mt-1">این منابع میان همهٔ اعضای گروه {{ $this->team->name }} مشترک‌اند و در صفحهٔ ساخت/ویرایش پیوند انتخاب می‌شوند.</flux:text>
        </div>
        <flux:button href="{{ route('links.index') }}" variant="outline">بازگشت به پیوندها</flux:button>
    </div>

    <flux:card class="space-y-3">
        <flux:heading size="lg">افزودن منبع</flux:heading>
        <form wire:submit="create" class="grid gap-3 sm:grid-cols-[1fr_2fr_auto]">
            <flux:select wire:model="newType" label="نوع">
                <flux:select.option value="folder">پوشه</flux:select.option>
                <flux:select.option value="category">دسته‌بندی</flux:select.option>
                <flux:select.option value="tag">برچسب / تگ</flux:select.option>
            </flux:select>
            <flux:input wire:model="newName" label="نام" placeholder="مثلاً کمپین تبلیغاتی - پیامکی شماره ۷" />
            <div class="flex items-end"><flux:button type="submit" variant="primary">افزودن</flux:button></div>
        </form>
    </flux:card>

    <div class="grid gap-4 lg:grid-cols-3">
        @foreach ([['key' => 'folders', 'title' => 'پوشه‌ها', 'type' => 'folder', 'items' => $this->folders], ['key' => 'categories', 'title' => 'دسته‌بندی‌ها', 'type' => 'category', 'items' => $this->categories], ['key' => 'tags', 'title' => 'برچسب‌ها / تگ‌ها', 'type' => 'tag', 'items' => $this->tags]] as $group)
            <flux:card class="space-y-3" wire:key="resource-group-{{ $group['key'] }}">
                <div class="flex items-center justify-between gap-2">
                    <flux:heading size="lg">{{ $group['title'] }}</flux:heading>
                    <flux:badge>{{ number_format($group['items']->count()) }}</flux:badge>
                </div>
                <flux:table>
                    <flux:table.columns>
                        <flux:table.column>نام</flux:table.column>
                        <flux:table.column align="end">پیوندها</flux:table.column>
                        <flux:table.column>عملیات</flux:table.column>
                    </flux:table.columns>
                    <flux:table.rows>
                        @forelse ($group['items'] as $item)
                            <flux:table.row :key="$group['key'].'-'.$item->id">
                                <flux:table.cell>{{ $item->name }}</flux:table.cell>
                                <flux:table.cell align="end">{{ number_format($item->links_count) }}</flux:table.cell>
                                <flux:table.cell>
                                    <div class="flex gap-1">
                                        <flux:button size="sm" variant="outline" wire:click="edit('{{ $group['type'] }}', {{ $item->id }})">ویرایش</flux:button>
                                        <flux:button size="sm" variant="danger" wire:click="delete('{{ $group['type'] }}', {{ $item->id }})" wire:confirm="این مورد حذف شود؟ پیوندها از این منبع جدا می‌شوند.">حذف</flux:button>
                                    </div>
                                </flux:table.cell>
                            </flux:table.row>
                        @empty
                            <flux:table.row><flux:table.cell colspan="3" class="py-6 text-center text-zinc-500">موردی ثبت نشده است.</flux:table.cell></flux:table.row>
                        @endforelse
                    </flux:table.rows>
                </flux:table>
            </flux:card>
        @endforeach
    </div>

    <flux:modal wire:model="showEditModal" class="max-w-md">
        <form wire:submit="update" class="space-y-4">
            <flux:heading size="lg">ویرایش منبع</flux:heading>
            <flux:input wire:model="editingName" label="نام" />
            <div class="flex justify-end gap-2">
                <flux:modal.close><flux:button type="button" variant="ghost">انصراف</flux:button></flux:modal.close>
                <flux:button type="submit" variant="primary">ذخیره</flux:button>
            </div>
        </form>
    </flux:modal>
</div>
