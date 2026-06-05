<?php

use App\Http\Controllers\Seeker\BookingController;
use App\Http\Controllers\Seeker\HostelController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role:seeker', 'profile.complete',])->group(function () {
    Route::view('/', 'seeker.dashboard')->name('dashboard');
    
    Route::get('/hostels', [HostelController::class, 'index'])->name('hostels.index');
    Route::get('/hostels/{hostel}', [HostelController::class, 'show'])->name('hostels.show');
    
    Route::prefix('bookings')->name('bookings.')->group(function () {
        Route::get('/', [BookingController::class, 'index'])->name('index');
        Route::patch('/{booking}/accept', [BookingController::class, 'accept'])->name('accept');
        Route::patch('/{booking}/reject', [BookingController::class, 'reject'])->name('reject');
    });
});