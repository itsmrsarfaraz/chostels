<?php

namespace App\Services\Booking;

use App\Enums\Booking\BookingSourceEnum;
use App\Enums\Booking\BookingStatusEnum;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CreateOwnerBookingService
{
    public function create(array $data): Booking
    {
        return DB::transaction(function () use ($data) {

            if (!empty($data['seeker_id'])) {
                $seeker = User::findOrFail($data['seeker_id']);
            } else {
                $seeker = app(InviteSeekerService::class)->create($data);
            }

            $activeBooking = Booking::query()
                ->where('bed_id', $data['bed_id'])
                ->whereIn('status', [
                    BookingStatusEnum::CONFIRMED,
                    BookingStatusEnum::CHECKED_IN,
                ])
                ->exists();

            if ($activeBooking) {

                throw \Illuminate\Validation\ValidationException::withMessages([
                    'bed_id' => 'Bed already occupied.'
                ]);
            }

            return Booking::create([
                'hostel_id' => $data['hostel_id'],
                'room_id' => $data['room_id'],
                'bed_id' => $data['bed_id'],
                'seeker_id' => $seeker->id,

                'check_in_date' => $data['check_in_date'],
                'monthly_rent' => $data['monthly_rent'],

                'status' => BookingStatusEnum::PENDING,
                'source' => BookingSourceEnum::OWNER,
            ]);
        });
    }
}