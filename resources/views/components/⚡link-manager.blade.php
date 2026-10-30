<?php

use App\Models\Link;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts::app')] #[Title('کوتاه‌کننده لینک')] class extends Component
{
    use WithPagination;

    public string $url = '';
    public string $title = '';
    public string $customCode = '';
    public ?string $expiresAt = null;

    protected function rules(): array
    {
        return [
            'url'        => ['required', 'url:http,https', 'max:2048'],
            'title'      => ['nullable', 'string', 'max:255'],
            'customCode' => [
                'nullable', 'alpha_dash:ascii', 'min:1', 'max:32',
                'unique:links,code',
                Rule::notIn(Link::RESERVED),
            ],
            'expiresAt'  => ['nullable', 'date', 'after:now'],
        ];
    }

    public function create(): void
    {
        $data = $this->validate();

        // جلوگیری از کوتاه کردن لینک خود سایت
        if (parse_url($data['url'], PHP_URL_HOST) === request()->getHost()) {
            $this->addError('url', 'نمی‌توانید لینک همین سایت را کوتاه کنید.');
            return;
        }

        $user = auth()->user();

        Link::create([
            'user_id'      => $user->id,
            'team_id'      => $user->current_team_id,
            'code'         => $data['customCode'] ?: Link::generateCode(),
            'original_url' => $data['url'],
            'title'        => $data['title'] ?: null,
            'expires_at'   => $data['expiresAt'] ?: null,
        ]);

        $this->reset('url', 'title', 'customCode', 'expiresAt');
        $this->resetPage();
    }

    public function toggle(int $id): void
    {
        $link = Link::where('user_id', auth()->id())->findOrFail($id);
        $link->update(['is_active' => ! $link->is_active]);
    }

    public function delete(int $id): void
    {
        Link::where('user_id', auth()->id())->findOrFail($id)->delete();
    }

    #[Computed]
    public function links()
    {
        return Link::where('user_id', auth()->id())->latest()->paginate(10);
    }
};
?>

<div class="mx-auto max-w-4xl space-y-8 p-6" dir="rtl">
    <flux:heading size="xl">کوتاه‌کننده لینک</flux:heading>

    <form wire:submit="create" class="space-y-4">
        <flux:input wire:model="url" label="لینک اصلی" placeholder="https://example.com/very/long/link" dir="ltr" />

        <div class="grid gap-4 md:grid-cols-3">
            <flux:input wire:model="title" label="عنوان (اختیاری)" />
            <flux:input wire:model="customCode" label="کد دلخواه (اختیاری)" dir="ltr" />
            <flux:input wire:model="expiresAt" type="datetime-local" label="تاریخ انقضا (اختیاری)" />
        </div>

        <flux:button type="submit" variant="primary">کوتاه کن</flux:button>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b text-right">
                    <th class="p-2">لینک کوتاه</th>
                    <th class="p-2">مقصد</th>
                    <th class="p-2">کلیک</th>
                    <th class="p-2">وضعیت</th>
                    <th class="p-2"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($this->links as $link)
                    <tr class="border-b" wire:key="link-{{ $link->id }}">
                        <td class="p-2" dir="ltr">
                            <a href="{{ $link->short_url }}" target="_blank" class="font-medium underline">
                                {{ $link->short_url }}
                            </a>
                        </td>
                        <td class="max-w-xs truncate p-2" dir="ltr" title="{{ $link->original_url }}">
                            {{ $link->original_url }}
                        </td>
                        <td class="p-2">{{ number_format($link->clicks) }}</td>
                        <td class="p-2">
                            <flux:badge :color="$link->isUsable() ? 'green' : 'zinc'">
                                {{ $link->isUsable() ? 'فعال' : 'غیرفعال/منقضی' }}
                            </flux:badge>
                        </td>
                        <td class="flex gap-2 p-2">
                            <flux:button size="sm" x-data
                                x-on:click="navigator.clipboard.writeText('{{ $link->short_url }}')">
                                کپی
                            </flux:button>
                            <flux:button size="sm" wire:click="toggle({{ $link->id }})">
                                {{ $link->is_active ? 'غیرفعال' : 'فعال' }}
                            </flux:button>
                            <flux:button size="sm" variant="danger"
                                wire:click="delete({{ $link->id }})"
                                wire:confirm="این لینک حذف شود؟">
                                حذف
                            </flux:button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-6 text-center text-zinc-500">هنوز لینکی نساخته‌اید.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $this->links->links() }}
</div>