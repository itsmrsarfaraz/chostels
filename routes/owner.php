<?php

use App\Http\Controllers\Owner\BookingController;
use App\Http\Controllers\Owner\HostelController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role:owner', 'profile.complete',])->group(function () {
    Route::view('/', 'owner.dashboard')->name('dashboard');
    Route::resource('hostels', HostelController::class);
    Route::patch('bookings/{booking}/confirm', [BookingController::class, 'confirm'])->name('bookings.confirm');
    Route::patch('bookings/{booking}/check-in', [BookingController::class, 'checkIn'])->name('bookings.check-in');
    Route::patch('bookings/{booking}/check-out', [BookingController::class, 'checkOut'])->name('bookings.check-out');
});