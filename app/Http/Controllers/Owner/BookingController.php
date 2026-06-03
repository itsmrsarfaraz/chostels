<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\StoreBookingRequest;
use App\Http\Requests\Owner\UpdateBookingRequest;
use App\Models\Booking;
use App\Services\Booking\BookingLifecycleService;
use App\Services\Booking\BookingService;
use App\Services\Booking\BookingStatusService;
use App\Services\Booking\CreateBookingService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BookingController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $bookings = Booking::query()
            ->whereHas('hostel', function ($query) use ($user) {
                $query->where('owner_id', $user->id);
            })
            ->with(['hostel', 'room', 'bed', 'seeker',])
            ->latest()
            ->get();

        return view('owner.bookings.index', compact('bookings'));
    }

    public function create()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $hostels = $user->hostels()->with('rooms.beds')->get();
        return view('owner.bookings.create', compact('hostels'));
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

    public function confirm(Booking $booking, BookingLifecycleService $service) {
        Gate::authorize('confirm', $booking);

        $service->confirm($booking);

        return back();
    }

    public function checkIn(Booking $booking, BookingLifecycleService $service) {
        Gate::authorize('checkIn', $booking);

        $service->checkIn($booking);

        return back();
    }

    public function checkOut(Booking $booking, BookingLifecycleService $service) {
        Gate::authorize('checkOut', $booking);

        $service->checkOut($booking);

        return back();
    }

    public function cancel(Booking $booking, BookingLifecycleService $service) {
        Gate::authorize('cancel', $booking);

        $service->cancel($booking);

        return back();
    }
}