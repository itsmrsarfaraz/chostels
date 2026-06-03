<?php

namespace App\Services\Booking;

use App\Enums\Booking\BookingSourceEnum;
use App\Enums\Booking\BookingStatusEnum;
use App\Models\Bed;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CreateBookingService
{
    public function __construct(
        private InviteSeekerService $inviteSeekerService
    ) {
    }

    public function create(array $data): Booking
    {
        return DB::transaction(function () use ($data) {

            $bed = Bed::findOrFail($data['bed_id']);

            $activeBooking = Booking::query()
                ->where('bed_id', $bed->id)
                ->whereIn('status', [
                    BookingStatusEnum::CONFIRMED->value,
                    BookingStatusEnum::CHECKED_IN->value,
                ])
                ->exists();

            if ($activeBooking) {
                throw ValidationException::withMessages([
                    'bed_id' => 'Bed is already occupied.',
                ]);
            }

            if (empty($data['seeker_id'])) {

                $seeker = $this->inviteSeekerService->create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'cnic' => $data['cnic'],
                ]);

                $data['seeker_id'] = $seeker->id;

                $data['source'] = BookingSourceEnum::OWNER->value;
            }

            return Booking::create([
                'hostel_id' => $data['hostel_id'],
                'room_id' => $data['room_id'],
                'bed_id' => $data['bed_id'],
                'seeker_id' => $data['seeker_id'],
                'check_in_date' => $data['check_in_date'],
                'monthly_rent' => $data['monthly_rent'],
                'source' => $data['source'] ?? BookingSourceEnum::SELF->value,
            ]);
        });
    }
}