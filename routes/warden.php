<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role:warden', 'profile.complete',])->group(function () {
    Route::view('/', 'warden.dashboard')
        ->name('dashboard');
});