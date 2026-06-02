<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role:super_admin', 'profile.complete',])->group(function () {
    Route::view('/', 'admin.dashboard')
        ->name('dashboard');
});