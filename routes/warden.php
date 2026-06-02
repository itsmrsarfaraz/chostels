<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified',])->group(function () {
    Route::view('/', 'warden.dashboard')
        ->name('dashboard');
});