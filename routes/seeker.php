<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role:seeker', 'profile.complete',])->group(function () {
    Route::view('/', 'seeker.dashboard')
        ->name('dashboard');
});