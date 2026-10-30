<?php

use App\Models\Link;

it('redirects to the original url and counts the click', function () {
    $link = Link::factory()->create([
        'code' => 'abc123',
        'original_url' => 'https://example.org/page',
    ]);

    $this->get('/abc123')
        ->assertStatus(302)
        ->assertRedirect('https://example.org/page');

    expect($link->fresh()->clicks)->toBe(1)
        ->and($link->clickLogs()->count())->toBe(1);
});

it('increments clicks on every visit', function () {
    $link = Link::factory()->create(['code' => 'multi1']);

    $this->get('/multi1');
    $this->get('/multi1');
    $this->get('/multi1');

    expect($link->fresh()->clicks)->toBe(3)
        ->and($link->clickLogs()->count())->toBe(3);
});

it('stores a hashed ip and never the raw one', function () {
    $link = Link::factory()->create(['code' => 'hash01']);

    $this->withServerVariables(['REMOTE_ADDR' => '203.0.113.9'])
        ->withHeaders(['Referer' => 'https://google.com/search'])
        ->get('/hash01');

    $click = $link->clickLogs()->first();

    expect($click->ip_hash)->toBe(hash('sha256', '203.0.113.9'.config('app.key')))
        ->and($click->ip_hash)->not->toContain('203.0.113.9')
        ->and($click->referer)->toBe('https://google.com/search');
});

it('returns 404 for an unknown code', function () {
    $this->get('/nope999')->assertNotFound();
});

it('returns 404 for codes shorter than 3 characters', function () {
    Link::factory()->create(['code' => 'ab']);

    $this->get('/ab')->assertNotFound();
});

it('returns 410 for an inactive link and does not count it', function () {
    $link = Link::factory()->inactive()->create(['code' => 'off123']);

    $this->get('/off123')->assertStatus(410);

    expect($link->fresh()->clicks)->toBe(0)
        ->and($link->clickLogs()->count())->toBe(0);
});

it('returns 410 for an expired link', function () {
    Link::factory()->expired()->create(['code' => 'old123']);

    $this->get('/old123')->assertStatus(410);
});

it('still works for a link that expires in the future', function () {
    Link::factory()->create([
        'code' => 'future1',
        'original_url' => 'https://example.org',
        'expires_at' => now()->addDay(),
    ]);

    $this->get('/future1')->assertRedirect('https://example.org');
});

it('does not hijack the real app routes', function () {
    $this->get('/login')->assertOk();
});
