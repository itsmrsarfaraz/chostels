<?php

namespace App\Services\Booking;

use App\Enums\Booking\BookingSourceEnum;
use App\Enums\Booking\BookingStatusEnum;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CreateSelfBookingService
{
    public function create(array $data): Booking
    {
        return DB::transaction(function () use ($data) {
            $activeBooking = Booking::query()
                ->where('bed_id', $data['bed_id'])
                ->whereIn('status', [
                    BookingStatusEnum::AWAITING_OWNER_APPROVAL,
                    BookingStatusEnum::CONFIRMED,
                    BookingStatusEnum::CHECKED_IN,
                ])
                ->exists();
            if ($activeBooking) {
                throw ValidationException::withMessages([
                    'bed_id' => 'Bed already booked.'
                ]);
            }
            return Booking::create([
                'hostel_id' => $data['hostel_id'],
                'room_id' => $data['room_id'],
                'bed_id' => $data['bed_id'],
                'seeker_id' => Auth::id(),
                'check_in_date' => $data['check_in_date'],
                'monthly_rent' => $data['monthly_rent'],
                'status' => BookingStatusEnum::AWAITING_OWNER_APPROVAL,
                'source' => BookingSourceEnum::SELF,
            ]);
        });
    }
}