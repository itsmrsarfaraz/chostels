<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role:owner'])->group(function () {
    Route::view('/', 'owner.dashboard')
        ->name('dashboard');
});