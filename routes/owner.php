<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role:owner', 'profile.complete',])->group(function () {
    Route::view('/', 'owner.dashboard')
        ->name('dashboard');
});