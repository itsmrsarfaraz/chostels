<?php

use App\Http\Controllers\Owner\BookingController;
use App\Http\Controllers\Owner\HostelController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role:owner', 'profile.complete',])->group(function () {
    Route::view('/', 'owner.dashboard')->name('dashboard');
    Route::resource('hostels', HostelController::class);
    Route::resource('bookings', BookingController::class);
    Route::patch('bookings/{booking}/confirm', [BookingController::class, 'confirm'])->name('bookings.confirm');
    Route::patch('bookings/{booking}/check-in', [BookingController::class, 'checkIn'])->name('bookings.check-in');
    Route::patch('bookings/{booking}/check-out', [BookingController::class, 'checkOut'])->name('bookings.check-out');
    Route::patch('bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    Route::get('booking-requests', [BookingController::class, 'requests'])->name('booking-requests.index');
});