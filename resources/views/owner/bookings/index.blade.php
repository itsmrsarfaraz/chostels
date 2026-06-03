<x-app-layout>

    <h1>Bookings</h1>

    <a href="{{ route('owner.bookings.create') }}">
        Create Booking
    </a>

    <table>

        <thead>
            <tr>
                <th>Hostel</th>
                <th>Room</th>
                <th>Bed</th>
                <th>Seeker</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

        @foreach($bookings as $booking)

            <tr>

                <td>{{ $booking->hostel->name }}</td>

                <td>{{ $booking->room->name }}</td>

                <td>{{ $booking->bed->bed_number }}</td>

                <td>{{ $booking->seeker->name }}</td>

                <td>{{ $booking->status->value }}</td>

                <td>

                    @if($booking->status === \App\Enums\Booking\BookingStatusEnum::PENDING)

                        <form
                            method="POST"
                            action="{{ route('owner.bookings.confirm', $booking) }}"
                        >
                            @csrf
                            @method('PATCH')

                            <button>
                                Confirm
                            </button>

                        </form>

                    @endif

                    @if($booking->status === \App\Enums\Booking\BookingStatusEnum::CONFIRMED)

                        <form
                            method="POST"
                            action="{{ route('owner.bookings.check-in', $booking) }}"
                        >
                            @csrf
                            @method('PATCH')

                            <button>
                                Check In
                            </button>

                        </form>

                    @endif

                    @if($booking->status === \App\Enums\Booking\BookingStatusEnum::CHECKED_IN)

                        <form
                            method="POST"
                            action="{{ route('owner.bookings.check-out', $booking) }}"
                        >
                            @csrf
                            @method('PATCH')

                            <button>
                                Check Out
                            </button>

                        </form>

                    @endif

                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

</x-app-layout>