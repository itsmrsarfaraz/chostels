<?php

namespace App\Services\Booking;

use App\Enums\Bed\BedStatusEnum;
use App\Enums\Booking\BookingStatusEnum;
use App\Models\Booking;
use Illuminate\Validation\ValidationException;

class BookingStatusService
{
    public function confirm(Booking $booking): void
    {
        if ($booking->status !== BookingStatusEnum::PENDING->value) {
            throw ValidationException::withMessages([
                'booking' => 'Only pending bookings can be confirmed.'
            ]);
        }

        $booking->update(['status' => BookingStatusEnum::CONFIRMED->value]);
        $booking->bed->update(['status' => BedStatusEnum::RESERVED->value]);
    }

    public function checkIn(Booking $booking): void
    {
        if ($booking->status !== BookingStatusEnum::CONFIRMED->value) {
            throw ValidationException::withMessages([
                'booking' => 'Booking must be confirmed.'
            ]);
        }

        $booking->update(['status' => BookingStatusEnum::CHECKED_IN->value]);
        $booking->bed->update(['status' => BedStatusEnum::OCCUPIED->value]);
    }

    public function checkOut(Booking $booking): void
    {
        if ($booking->status !== BookingStatusEnum::CHECKED_IN->value) {
            throw ValidationException::withMessages([
                'booking' => 'Booking must be checked in.'
            ]);
        }

        $booking->update([
            'status' => BookingStatusEnum::CHECKED_OUT->value,
            'check_out_date' => now(),
        ]);
        $booking->bed->update([
            'status' => BedStatusEnum::AVAILABLE->value
        ]);
    }

    public function cancel(Booking $booking): void
    {
        if (
            in_array(
                $booking->status,
                [
                    BookingStatusEnum::CHECKED_OUT->value,
                    BookingStatusEnum::CANCELLED->value,
                ]
            )
        ) {
            throw ValidationException::withMessages([
                'booking' => 'Booking cannot be cancelled.'
            ]);
        }

        $booking->update([
            'status' => BookingStatusEnum::CANCELLED->value
        ]);

        $booking->bed->update([
            'status' => BedStatusEnum::AVAILABLE->value
        ]);
    }
}