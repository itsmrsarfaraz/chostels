<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seeker\StoreBookingRequest;
use App\Services\Booking\CreateSelfBookingService;

class BookingRequestController extends Controller
{
    public function store(StoreBookingRequest $request, CreateSelfBookingService $service) {
        $service->create($request->validated());
        return redirect()
            ->route('seeker.bookings.index')
            ->with(
                'success',
                'Booking request submitted.'
            );
    }
}