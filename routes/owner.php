<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified',])->group(function () {
    Route::view('/', 'owner.dashboard')
        ->name('dashboard');
});