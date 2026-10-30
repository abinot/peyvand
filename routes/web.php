<?php

use App\Http\Middleware\EnsureTeamMembership;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::prefix('{current_team}')
    ->middleware(['auth', 'verified', EnsureTeamMembership::class])
    ->group(function () {
        Route::view('dashboard', 'dashboard')->name('dashboard');
    });

require __DIR__.'/settings.php';

use App\Http\Controllers\RedirectController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::livewire('links', 'link-manager')->name('links.index');
});

// حتماً انتهای فایل باشد
Route::get('/{code}', RedirectController::class)
    ->where('code', '[A-Za-z0-9_-]{1,32}')
    ->name('links.redirect');
