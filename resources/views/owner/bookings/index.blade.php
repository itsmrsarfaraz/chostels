<x-app-layout>

    <h1>Bookings</h1>

    <a href="{{ route('owner.bookings.create') }}">
        Create Booking
    </a>

    <div class="grid grid-cols-4 gap-4 mb-6">

        <div class="p-4 bg-white rounded shadow">
            <h3>Total</h3>
            <div class="text-3xl font-bold">
                {{ $stats['total'] }}
            </div>
        </div>

        <div class="p-4 bg-white rounded shadow">
            <h3>Pending</h3>
            <div class="text-3xl font-bold">
                {{ $stats['pending'] }}
            </div>
        </div>

        <div class="p-4 bg-white rounded shadow">
            <h3>Confirmed</h3>
            <div class="text-3xl font-bold">
                {{ $stats['confirmed'] }}
            </div>
        </div>

        <div class="p-4 bg-white rounded shadow">
            <h3>Checked In</h3>
            <div class="text-3xl font-bold">
                {{ $stats['checked_in'] }}
            </div>
        </div>

    </div>

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
                    <a href="{{ route('owner.bookings.show', $booking) }}">View</a>

                    @if($booking->status === \App\Enums\Booking\BookingStatusEnum::AWAITING_ACCEPTANCE)
                    <form
                        method="POST"
                        action="{{ route('owner.bookings.approve-request',$booking) }}"
                        class="inline"
                    >
                        @csrf
                        @method('PATCH')

                        <button class="bg-green-500 text-white px-3 py-1 rounded">
                            Approve
                        </button>
                    </form>

                    <form
                        method="POST"
                        action="{{ route('owner.bookings.reject-request',$booking) }}"
                        class="inline"
                    >
                        @csrf
                        @method('PATCH')

                        <button class="bg-red-500 text-white px-3 py-1 rounded">
                            Reject
                        </button>
                    </form>

                    @endif

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