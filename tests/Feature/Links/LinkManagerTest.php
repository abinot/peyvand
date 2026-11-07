<?php

use App\Models\Link;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('redirects guests to login', function () {
    auth()->logout();

    $this->get(route('links.index'))->assertRedirect(route('login'));
});

it('renders the page for authenticated users', function () {
    $this->get(route('links.index'))
        ->assertOk()
        ->assertSee('مدیریت پیوندها');
});

it('creates a link with a random 6 character code', function () {
    Livewire::test('link-manager')
        ->set('url', 'https://example.org/long/path')
        ->set('title', 'نمونه')
        ->call('create')
        ->assertHasNoErrors()
        ->assertSet('url', '');

    $link = Link::first();

    expect($link->created_by)->toBe($this->user->id)
        ->and($link->team_id)->toBe($this->user->current_team_id)
        ->and($link->original_url)->toBe('https://example.org/long/path')
        ->and($link->title)->toBe('نمونه')
        ->and($link->code)->toHaveLength(6);
});

it('creates a link with a custom code and expiry', function () {
    Livewire::test('link-manager')
        ->set('url', 'https://example.org')
        ->set('customCode', 'my-link')
        ->set('expiresAt', now()->addWeek()->format('Y-m-d\TH:i'))
        ->call('create')
        ->assertHasNoErrors();

    $link = Link::where('code', 'my-link')->first();

    expect($link)->not->toBeNull()
        ->and($link->expires_at)->not->toBeNull()
        ->and($link->expires_at->isFuture())->toBeTrue();
});

it('rejects invalid urls', function (string $url) {
    Livewire::test('link-manager')
        ->set('url', $url)
        ->call('create')
        ->assertHasErrors(['url']);

    expect(Link::count())->toBe(0);
})->with([
    'empty' => '',
    'not a url' => 'hello world',
    'javascript' => 'javascript:alert(1)',
    'ftp' => 'ftp://example.org/file',
]);

it('rejects shortening a link of this site itself', function () {
    Livewire::test('link-manager')
        ->set('url', 'http://localhost/dashboard')
        ->call('create')
        ->assertHasErrors(['url']);

    expect(Link::count())->toBe(0);
});

it('rejects a duplicate custom code', function () {
    Link::factory()->create(['code' => 'taken1']);

    Livewire::test('link-manager')
        ->set('url', 'https://example.org')
        ->set('customCode', 'taken1')
        ->call('create')
        ->assertHasErrors(['customCode']);
});

it('rejects reserved and malformed custom codes', function (string $code) {
    Livewire::test('link-manager')
        ->set('url', 'https://example.org')
        ->set('customCode', $code)
        ->call('create')
        ->assertHasErrors(['customCode']);
})->with(['login', 'dashboard', 'settings', 'ab', 'has space', 'کد-فارسی']);

it('rejects an expiry date in the past', function () {
    Livewire::test('link-manager')
        ->set('url', 'https://example.org')
        ->set('expiresAt', now()->subDay()->format('Y-m-d\TH:i'))
        ->call('create')
        ->assertHasErrors(['expiresAt']);
});

it('lists only links belonging to the current team', function () {
    Link::factory()->create(['team_id' => $this->user->current_team_id, 'created_by' => $this->user->id, 'code' => 'mine001']);
    Link::factory()->create(['code' => 'other01']);

    Livewire::test('link-manager')
        ->assertSee('mine001')
        ->assertDontSee('other01');
});

it('toggles the status of an own link', function () {
    $link = Link::factory()->create(['team_id' => $this->user->current_team_id, 'created_by' => $this->user->id]);

    $component = Livewire::test('link-manager');

    $component->call('toggle', $link->id);
    expect($link->fresh()->is_active)->toBeFalse();

    $component->call('toggle', $link->id);
    expect($link->fresh()->is_active)->toBeTrue();
});

it('deletes an own link', function () {
    $link = Link::factory()->create(['team_id' => $this->user->current_team_id, 'created_by' => $this->user->id]);

    Livewire::test('link-manager')->call('delete', $link->id);

    $this->assertModelMissing($link);
});

it('cannot toggle or delete links belonging to another team', function () {
    $foreign = Link::factory()->create(['is_active' => true]);

    rescue(fn () => Livewire::test('link-manager')->call('toggle', $foreign->id), report: false);
    rescue(fn () => Livewire::test('link-manager')->call('delete', $foreign->id), report: false);

    expect($foreign->fresh())->not->toBeNull()
        ->and($foreign->fresh()->is_active)->toBeTrue();
});

it('allows team members to edit the destination without changing the short code', function () {
    $link = Link::factory()->create([
        'team_id' => $this->user->current_team_id,
        'created_by' => $this->user->id,
        'code' => 'edit123',
        'original_url' => 'https://example.org/old',
    ]);

    Livewire::test('link-manager')
        ->call('edit', $link->id)
        ->set('editUrl', 'https://example.org/new')
        ->set('editTitle', 'مقصد تازه')
        ->call('saveEdit')
        ->assertHasNoErrors();

    expect($link->fresh()->code)->toBe('edit123')
        ->and($link->fresh()->original_url)->toBe('https://example.org/new')
        ->and($link->fresh()->title)->toBe('مقصد تازه');
});
