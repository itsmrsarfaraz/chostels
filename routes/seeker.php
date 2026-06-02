<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role:seeker'])->group(function () {
    Route::view('/', 'seeker.dashboard')
        ->name('dashboard');
});