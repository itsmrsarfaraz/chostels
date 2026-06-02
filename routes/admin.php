<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified',])->group(function () {
    Route::view('/', 'admin.dashboard')
        ->name('dashboard');
});