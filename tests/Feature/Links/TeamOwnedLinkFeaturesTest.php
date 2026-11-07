<?php

use App\Models\Link;
use App\Models\LinkCategory;
use App\Models\LinkFolder;
use App\Models\LinkTag;
use App\Models\User;
use Livewire\Livewire;

it('stores links and their organization under the current team and allows the team to edit them', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $folder = LinkFolder::factory()->create(['team_id' => $user->current_team_id, 'name' => 'بازاریابی']);
    $category = LinkCategory::factory()->create(['team_id' => $user->current_team_id, 'name' => 'محصولات']);
    $tag = LinkTag::factory()->create(['team_id' => $user->current_team_id, 'name' => 'پاییز']);

    Livewire::test('link-manager')
        ->set('url', 'https://example.org/old')
        ->set('title', 'پیوند گروه')
        ->set('folderId', $folder->id)
        ->set('categoryId', $category->id)
        ->set('tagIds', [(string) $tag->id])
        ->set('utmSource', 'newsletter')
        ->set('utmMedium', 'email')
        ->set('utmCampaign', 'autumn-launch')
        ->set('metadataRows', [
            ['key' => 'source_id', 'value' => '42', 'mode' => 'store', 'parameter' => ''],
        ])
        ->call('create')
        ->assertHasNoErrors();

    $link = Link::query()->firstOrFail();

    expect($link->team_id)->toBe($user->current_team_id)
        ->and($link->created_by)->toBe($user->id)
        ->and($link->folder_id)->toBe($folder->id)
        ->and($link->category_id)->toBe($category->id)
        ->and($link->metadata)->toMatchArray([
            'source_id' => '42',
            'utm_defaults' => [
                'utm_source' => 'newsletter',
                'utm_medium' => 'email',
                'utm_campaign' => 'autumn-launch',
            ],
        ])
        ->and($link->tags()->count())->toBe(1);

    Livewire::test('link-manager')
        ->call('edit', $link->id)
        ->set('editUrl', 'https://example.org/new')
        ->set('editTitle', 'مقصد تازه')
        ->call('saveEdit')
        ->assertHasNoErrors();

    expect($link->fresh()->code)->toBe($link->code)
        ->and($link->fresh()->original_url)->toBe('https://example.org/new')
        ->and($link->fresh()->title)->toBe('مقصد تازه');
});

it('does not let a team edit or list another team links', function () {
    $firstUser = User::factory()->create();
    $secondUser = User::factory()->create();
    $foreignLink = Link::factory()->create([
        'team_id' => $secondUser->current_team_id,
        'created_by' => $secondUser->id,
        'code' => 'foreign7',
    ]);

    $this->actingAs($firstUser);

    Livewire::test('link-manager')->assertDontSee('foreign7');

    rescue(fn () => Livewire::test('link-manager')->call('edit', $foreignLink->id), report: false);

    expect($foreignLink->fresh()->code)->toBe('foreign7');
});

it('applies default utm values, lets incoming values override them and records click context', function () {
    $link = Link::factory()->create([
        'code' => 'utmteam',
        'original_url' => 'https://example.org/offer?ref=existing&utm_source=old#details',
        'metadata' => [
            'utm_defaults' => [
                'utm_source' => 'sms',
                'utm_medium' => 'campaign',
                'utm_campaign' => 'autumn',
            ],
        ],
    ]);

    $this->withHeaders([
        'User-Agent' => 'Mozilla/5.0 (Linux; Android 12; Pixel) AppleWebKit/537.36 Chrome/120.0 Mobile Safari/537.36',
    ])->get('/utmteam?utm_source=whatsapp')
        ->assertRedirect('https://example.org/offer?ref=existing&utm_source=whatsapp&utm_medium=campaign&utm_campaign=autumn#details');

    $click = $link->clickLogs()->firstOrFail();

    expect($click->utm_parameters)->toMatchArray([
        'utm_source' => 'whatsapp',
        'utm_medium' => 'campaign',
        'utm_campaign' => 'autumn',
    ])
        ->and($click->device_type)->toBe('mobile')
        ->and($click->browser)->toBe('Chrome')
        ->and($click->platform)->toBe('Android');
});

it('shows team-scoped analytics, group import and resource management pages', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('analytics.index'))
        ->assertOk()
        ->assertSee('گزارش آمار گروه');

    $this->get(route('links.bulk'))
        ->assertOk()
        ->assertSee('ساخت گروهی و ورود و خروجی داده');

    $this->get(route('links.resources'))
        ->assertOk()
        ->assertSee('مدیریت پوشه‌ها، دسته‌بندی‌ها و برچسب‌ها');
});
