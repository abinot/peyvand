<?php

use App\Models\Link;

it('is usable when active and not expired', function (array $state, bool $expected) {
    $link = Link::factory()->make($state);

    expect($link->isUsable())->toBe($expected);
})->with([
    'active, no expiry' => [['is_active' => true,  'expires_at' => null], true],
    'active, future' => [['is_active' => true,  'expires_at' => now()->addDay()], true],
    'active, expired' => [['is_active' => true,  'expires_at' => now()->subMinute()], false],
    'inactive' => [['is_active' => false, 'expires_at' => null], false],
    'inactive + expired' => [['is_active' => false, 'expires_at' => now()->subDay()], false],
]);

it('builds the short url from the code', function () {
    $link = Link::factory()->make(['code' => 'xyz789']);

    expect($link->short_url)->toBe(url('xyz789'));
});

it('generates a unique code of the requested length', function () {
    $codes = collect(range(1, 20))->map(function () {
        $code = Link::generateCode(8);
        Link::factory()->create(['code' => $code]);

        return $code;
    });

    expect($codes->unique())->toHaveCount(20)
        ->and($codes->every(fn ($c) => strlen($c) === 8))->toBeTrue();
});

it('never generates a reserved word', function () {
    foreach (range(1, 50) as $i) {
        expect(Link::RESERVED)->not->toContain(strtolower(Link::generateCode()));
    }
});

it('deletes click logs together with the link', function () {
    $link = Link::factory()->create();
    $link->clickLogs()->create(['ip_hash' => 'x']);

    $link->delete();

    $this->assertDatabaseCount('link_clicks', 0);
});
