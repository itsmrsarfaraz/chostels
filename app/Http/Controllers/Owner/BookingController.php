<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\StoreBookingRequest;
use App\Http\Requests\Owner\UpdateBookingRequest;
use App\Models\Booking;
use App\Services\Booking\BookingService;
use App\Services\Booking\BookingStatusService;
use App\Services\Booking\CreateBookingService;
use Illuminate\Support\Facades\Gate;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::latest()->paginate();
        return view('owner.bookings.index', compact('bookings'));
    }

    public function create()
    {
        return view('owner.bookings.create');
    }

    public function store(StoreBookingRequest $request, CreateBookingService $service) {
        $service->create($request->validated());
        return redirect()->route('owner.bookings.index');
    }

    public function edit(Booking $booking)
    {
        Gate::authorize('update', $booking);

        return view('owner.bookings.edit', compact('booking'));
    }

    public function update(UpdateBookingRequest $request, Booking $booking, BookingService $service) {
        Gate::authorize('update', $booking);

        $service->update(
            $booking,
            $request->validated()
        );

        return redirect()->route('owner.bookings.index');
    }

    public function confirm(Booking $booking, BookingStatusService $service) {
        Gate::authorize('manage', $booking);

        $service->confirm($booking);

        return back();
    }

    public function checkIn(Booking $booking, BookingStatusService $service) {
        Gate::authorize('manage', $booking);

        $service->checkIn($booking);

        return back();
    }

    public function checkOut(Booking $booking, BookingStatusService $service) {
        Gate::authorize('manage', $booking);

        $service->checkOut($booking);

        return back();
    }

    public function cancel(Booking $booking, BookingStatusService $service) {
        Gate::authorize('manage', $booking);

        $service->cancel($booking);

        return back();
    }
}