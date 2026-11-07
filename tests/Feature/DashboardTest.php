<?php

use App\Models\Link;
use App\Models\LinkCategory;
use App\Models\LinkFolder;
use App\Models\User;
use Livewire\Livewire;

test('guests are redirected to the login page', function () {
    $response = $this->get(route('dashboard'));

    $response->assertRedirect(route('login'));
});

test('authenticated users can visit the dashboard', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(route('dashboard'));

    $response->assertOk();
});

test('dashboard shows the short link options and recent links of the current team', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    Link::factory()->create([
        'team_id' => $user->current_team_id,
        'created_by' => $user->id,
        'code' => 'mine012',
        'title' => 'پیوند داشبورد',
    ]);
    Link::factory()->create(['code' => 'other01']);

    $this->get(route('dashboard'))
        ->assertOk()
        ->assertSee('ساخت پیوند کوتاه')
        ->assertSee('کد دلخواه')
        ->assertSee('زمان انقضا')
        ->assertSee('پوشه')
        ->assertSee('دسته‌بندی')
        ->assertSee('برچسب‌ها')
        ->assertSee('پارامترهای پیش‌فرض UTM')
        ->assertSee('mine012')
        ->assertDontSee('other01');
});

test('creates a short link from the dashboard with all options', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $folder = LinkFolder::factory()->create(['team_id' => $user->current_team_id, 'name' => 'بازاریابی']);
    $category = LinkCategory::factory()->create(['team_id' => $user->current_team_id, 'name' => 'محصولات']);

    Livewire::test('short-link-dashboard')
        ->set('url', 'https://example.org/dashboard')
        ->set('title', 'از داشبورد')
        ->set('customCode', 'dash123')
        ->set('expiresAt', now()->addWeek()->format('Y-m-d\TH:i'))
        ->set('folderId', $folder->id)
        ->set('categoryId', $category->id)
        ->set('tagsInput', 'داشبورد، تست')
        ->set('utmSource', 'dashboard')
        ->set('utmMedium', 'panel')
        ->set('metadataJson', '{"from":"dashboard"}')
        ->call('create')
        ->assertHasNoErrors();

    $link = Link::query()->where('code', 'dash123')->firstOrFail();

    expect($link->team_id)->toBe($user->current_team_id)
        ->and($link->created_by)->toBe($user->id)
        ->and($link->folder_id)->toBe($folder->id)
        ->and($link->category_id)->toBe($category->id)
        ->and($link->expires_at->isFuture())->toBeTrue()
        ->and($link->metadata)->toMatchArray([
            'from' => 'dashboard',
            'utm_defaults' => ['utm_source' => 'dashboard', 'utm_medium' => 'panel'],
        ])
        ->and($link->tags()->pluck('name')->sort()->values()->all())->toBe(['تست', 'داشبورد']);
});

test('dashboard rejects shortening a link of this site itself', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    Livewire::test('short-link-dashboard')
        ->set('url', 'http://localhost/dashboard')
        ->call('create')
        ->assertHasErrors(['url']);

    expect(Link::count())->toBe(0);
});

test('dashboard only offers links of the current team for quick toggle', function () {
    $firstUser = User::factory()->create();
    $secondUser = User::factory()->create();
    $foreignLink = Link::factory()->create([
        'team_id' => $secondUser->current_team_id,
        'created_by' => $secondUser->id,
        'code' => 'foreignc',
    ]);

    $this->actingAs($firstUser);

    Livewire::test('short-link-dashboard')->assertDontSee('foreignc');

    rescue(fn () => Livewire::test('short-link-dashboard')->call('toggle', $foreignLink->id), report: false);

    expect($foreignLink->fresh()->is_active)->toBeTrue();
});
