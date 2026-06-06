<?php

namespace App\Services\Booking;

use App\Enums\Bed\BedStatusEnum;
use App\Enums\Booking\BookingStatusEnum;
use App\Models\Booking;

class BookingLifecycleService
{
    public function confirm(Booking $booking): void
    {
        $booking->update([
            'status' => BookingStatusEnum::CONFIRMED,
        ]);
    }

    public function checkIn(Booking $booking): void
    {
        $booking->update([
            'status' => BookingStatusEnum::CHECKED_IN,
        ]);

        $booking->bed->update([
            'status' => BedStatusEnum::OCCUPIED,
        ]);
    }

    public function checkOut(Booking $booking): void
    {
        $booking->update([
            'status' => BookingStatusEnum::CHECKED_OUT,
        ]);

        $booking->bed->update([
            'status' => BedStatusEnum::AVAILABLE,
        ]);
    }

    public function cancel(Booking $booking): void
    {
        $booking->update([
            'status' => BookingStatusEnum::CANCELLED,
        ]);

        $booking->bed->update([
            'status' => BedStatusEnum::AVAILABLE,
        ]);
    }

    public function accept(Booking $booking): void
    {
        $booking->update([
            'status' => BookingStatusEnum::CONFIRMED,
        ]);
    }

    public function reject(Booking $booking): void
    {
        $booking->update([
            'status' => BookingStatusEnum::REJECTED,
        ]);
    }

    public function approveRequest(Booking $booking): void {
        $booking->update([
            'status' => BookingStatusEnum::CONFIRMED,
        ]);
    }

    public function rejectRequest(Booking $booking): void {
        $booking->update([
            'status' => BookingStatusEnum::REJECTED,
        ]);
    }
}