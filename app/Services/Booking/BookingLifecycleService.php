<?php

namespace App\Services\Booking;

use App\Enums\Booking\BookingStatusEnum;
use App\Models\Booking;

class BookingLifecycleService
{
    public function confirm(Booking $booking): void
    {
        $booking->confirm();
    }

    public function checkIn(Booking $booking): void
    {
        $booking->checkIn();
    }

    public function checkOut(Booking $booking): void
    {
        $booking->checkOut();
    }

    public function cancel(Booking $booking): void
    {
        $booking->cancel();
    }

    public function accept(Booking $booking): void {
        $booking->update([
            'status' => BookingStatusEnum::CONFIRMED
        ]);
    }

    public function reject(Booking $booking): void {
        $booking->update([
            'status' => BookingStatusEnum::REJECTED
        ]);
    }
}