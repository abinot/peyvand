<?php

use App\Models\Link;
use App\Models\LinkFolder;
use App\Services\Links\LinkImportService;
use App\Models\User;
use Illuminate\Support\Facades\DB;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('creates regular team-owned links from a JSON group without a separate campaign', function () {
    $count = app(LinkImportService::class)->import(
        (int) $this->user->current_team_id,
        (int) $this->user->id,
        [
            'folder' => 'کمپین تبلیغاتی - پیامکی شماره ۷',
            'records' => [
                [
                    'url' => 'https://example.org/offer',
                    'metadata' => ['first_name' => 'علی', 'phone' => '09120000000', 'gender' => 'male'],
                    'utm' => ['utm_source' => 'sms', 'utm_content' => '{{phone}}'],
                    'get' => ['phone' => '{{phone}}'],
                ],
            ],
        ],
    );

    $link = Link::query()->firstOrFail();

    expect($count)->toBe(1)
        ->and($link->team_id)->toBe($this->user->current_team_id)
        ->and($link->folder->name)->toBe('کمپین تبلیغاتی - پیامکی شماره ۷')
        ->and($link->code)->toHaveLength(6)
        ->and($link->metadata['phone'])->toBe('09120000000')
        ->and(DB::table('links')->where('id', $link->id)->value('metadata'))->not->toContain('09120000000')
        ->and($link->tracking_rules['query']['phone'])->toBe('{{phone}}')
        ->and($link->tracking_rules['utm']['utm_content'])->toBe('{{phone}}');
});

it('imports CSV extra columns as metadata and creates a random short code when custom_url is blank', function () {
    $service = app(LinkImportService::class);
    $document = $service->parse("url,custom_url,title,phone,gender,utm_source,get_phone\nhttps://example.org/deal,,تخفیف,09121111111,female,sms,09121111111", 'csv');
    $count = $service->import((int) $this->user->current_team_id, (int) $this->user->id, $document);
    $link = Link::query()->firstOrFail();

    expect($count)->toBe(1)
        ->and($link->code)->toHaveLength(6)
        ->and($link->metadata['phone'])->toBe('09121111111')
        ->and($link->metadata['gender'])->toBe('female')
        ->and($link->metadata['utm_defaults']['utm_source'])->toBe('sms')
        ->and($link->tracking_rules['query']['phone'])->toBe('09121111111')
        ->and(isset($link->tracking_rules['utm']['utm_source']))->toBeFalse();
});

it('uses default folder and destination when CSV cells are blank and maps template UTM values', function () {
    $service = app(LinkImportService::class);
    $document = $service->parse(
        "url,folder,phone,utm_content\n, ,09123334444,{{phone}}",
        'csv',
    );
    $document['folder'] = 'پوشهٔ پیش‌فرض';
    $document['destination_url'] = 'https://example.org/default';

    $service->import((int) $this->user->current_team_id, (int) $this->user->id, $document);
    $link = Link::query()->firstOrFail();

    expect($link->original_url)->toBe('https://example.org/default')
        ->and($link->folder->name)->toBe('پوشهٔ پیش‌فرض')
        ->and($link->tracking_rules['utm']['utm_content'])->toBe('{{phone}}')
        ->and($link->metadata['phone'])->toBe('09123334444')
        ->and(array_key_exists('utm_defaults', $link->metadata))->toBeFalse();
});

it('keeps groups isolated when creating folders and links', function () {
    $otherUser = User::factory()->create();
    app(LinkImportService::class)->import(
        (int) $this->user->current_team_id,
        (int) $this->user->id,
        ['folder' => 'گروه اول', 'records' => [['url' => 'https://example.org/a']]],
    );
    app(LinkImportService::class)->import(
        (int) $otherUser->current_team_id,
        (int) $otherUser->id,
        ['folder' => 'گروه دوم', 'records' => [['url' => 'https://example.org/b']]],
    );

    expect(Link::query()->where('team_id', $this->user->current_team_id)->count())->toBe(1)
        ->and(LinkFolder::query()->where('team_id', $this->user->current_team_id)->pluck('name')->all())->toBe(['گروه اول'])
        ->and(LinkFolder::query()->where('team_id', $otherUser->current_team_id)->pluck('name')->all())->toBe(['گروه دوم']);
});

it('renders the separate resource and group import screens', function () {
    $this->get(route('links.resources'))->assertOk()->assertSee('مدیریت پوشه‌ها، دسته‌بندی‌ها و برچسب‌ها');
    $this->get(route('links.bulk'))->assertOk()->assertSee('ساخت گروهی و ورود و خروجی داده');
});

it('creates JSON metadata through key value rows and maps it to UTM', function () {
    Livewire\Livewire::test('link-manager')
        ->set('url', 'https://example.org/offer')
        ->set('metadataRows', [
            ['key' => 'phone', 'value' => '09120000000', 'mode' => 'utm', 'parameter' => 'utm_content'],
        ])
        ->call('create')
        ->assertHasNoErrors();

    $link = Link::query()->firstOrFail();

    expect($link->metadata['phone'])->toBe('09120000000')
        ->and($link->tracking_rules['utm']['utm_content'])->toBe('{{phone}}');
});
