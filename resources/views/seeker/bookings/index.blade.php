<x-app-layout>
    <h1>My Bookings</h1>
    @foreach($bookings as $booking)
        <div>
            <h3>{{ $booking->hostel->name }}</h3>
            <p>Room: {{ $booking->room->name }}</p>
            <p>Bed: {{ $booking->bed->bed_number }}</p>
            <p>Status: {{ $booking->status->value }}</p>
            @if($booking->status === \App\Enums\Booking\BookingStatusEnum::AWAITING_ACCEPTANCE)
                <form method="POST" action="{{ route('seeker.bookings.accept', $booking) }}">
                    @csrf
                    @method('PATCH')
                    <button>Accept</button>
                </form>
                <form method="POST" action="{{ route('seeker.bookings.reject', $booking) }}">
                    @csrf
                    @method('PATCH')
                    <button>Reject</button>
                </form>
            @endif
        </div>
    @endforeach
</x-app-layout>