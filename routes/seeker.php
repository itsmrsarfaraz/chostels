<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified',])->group(function () {
    Route::view('/', 'seeker.dashboard')
        ->name('dashboard');
});