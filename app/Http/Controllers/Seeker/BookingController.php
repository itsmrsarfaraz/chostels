<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Services\Booking\BookingLifecycleService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BookingController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $bookings = $user->bookings()->with(['hostel', 'room', 'bed'])->latest()->get();
        return view('seeker.bookings.index',compact('bookings'));
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
}