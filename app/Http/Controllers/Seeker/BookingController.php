<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seeker\StoreBookingRequest;
use App\Models\Booking;
use App\Services\Booking\BookingLifecycleService;
use App\Services\Booking\CreateSelfBookingService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BookingController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $bookings = $user->bookings()->latest()->paginate(20);
        $stats = [
            'total' => $user->bookings()->count(),

            'pending' => $user->bookings()
                ->where('status', 'pending')
                ->count(),

            'confirmed' => $user->bookings()
                ->where('status', 'confirmed')
                ->count(),

            'checked_in' => $user->bookings()
                ->where('status', 'checked_in')
                ->count(),
        ];

        return view('seeker.bookings.index', compact('bookings', 'stats'));
    }

    public function accept(Booking $booking, BookingLifecycleService $service) {
        Gate::authorize('accept', $booking);
        $service->accept($booking);
        return back();
    }

    public function reject(Booking $booking, BookingLifecycleService $service) {
        Gate::authorize('reject', $booking);
        $service->reject($booking);
        return back();
    }

    public function store(StoreBookingRequest $request, CreateSelfBookingService $service) {
        $service->create($request->validated());
        return redirect()
            ->route('seeker.bookings.index')
            ->with('success', 'Booking request submitted.');
    }

}