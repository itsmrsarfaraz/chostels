<?php

use App\Http\Controllers\Seeker\BookingController;
use App\Http\Controllers\Seeker\HostelController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role:seeker', 'profile.complete',])->group(function () {
    Route::view('/', 'seeker.dashboard')->name('dashboard');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::patch('/bookings/{booking}/accept', [BookingController::class, 'accept'])->name('bookings.accept');
    Route::patch('/bookings/{booking}/reject', [BookingController::class, 'reject'])->name('bookings.reject');
    Route::get('/hostels', [HostelController::class, 'index'])->name('hostels.index');
    Route::get('/hostels/{hostel}', [HostelController::class, 'show'])->name('hostels.show');
});