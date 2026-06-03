<?php

namespace App\Services\Booking;

use App\Models\Booking;

class BookingService
{
    public function update(Booking $booking, array $data): Booking
    {
        $booking->update($data);

        return $booking;
    }
}