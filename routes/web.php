<?php

use App\Http\Controllers\RedirectController;
use App\Http\Middleware\EnsureTeamMembership;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::prefix('{current_team}')
    ->middleware(['auth', 'verified', EnsureTeamMembership::class])
    ->group(function () {
        Route::view('dashboard', 'dashboard')->name('dashboard');
    });

require __DIR__.'/settings.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::livewire('links', 'link-manager')->name('links.index');
    Route::livewire('links/bulk', 'link-bulk-manager')->name('links.bulk');
    Route::livewire('links/resources', 'link-resources-manager')->name('links.resources');
    Route::livewire('analytics', 'analytics-manager')->name('analytics.index');

    // Backward-compatible name for old views; campaigns are now ordinary bulk-imported links.
    Route::get('_legacy/campaigns', fn () => redirect()->route('links.bulk'))
        ->name('campaigns.index');
});

// Keep this route last so it cannot shadow named application routes.
Route::get('/{code}', RedirectController::class)
    ->where('code', '[A-Za-z0-9_-]{3,32}')
    ->name('links.redirect');
