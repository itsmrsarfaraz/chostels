<?php

use App\Http\Controllers\Seeker\BookingController;
use App\Http\Controllers\Seeker\BookingRequestController;
use App\Http\Controllers\Seeker\HostelController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role:seeker', 'profile.complete',])->group(function () {
    Route::view('/', 'seeker.dashboard')->name('dashboard');

    Route::prefix('hostels')->name('hostels.')->group(function () {
        Route::get('/', [HostelController::class,'index'])->name('index');
        Route::get('/{hostel}', [HostelController::class,'show'])->name('show');
    });
    
    Route::prefix('bookings')->name('bookings.')->group(function () {
        Route::get('/', [BookingController::class, 'index'])->name('index');
        Route::post('/bookings', [BookingController::class,'store'])->name('bookings.store');
        Route::patch('/{booking}/accept', [BookingController::class, 'accept'])->name('accept');
        Route::patch('/{booking}/reject', [BookingController::class, 'reject'])->name('reject');
    });

    Route::post('booking-requests',[BookingRequestController::class, 'store'])->name('booking-requests.store');
});