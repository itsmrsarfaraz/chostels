<x-app-layout>

<div class="max-w-7xl mx-auto py-8">

    <h1 class="text-2xl font-bold mb-6">
        My Bookings
    </h1>

    <div class="grid grid-cols-4 gap-4 mb-6">

        <div class="p-4 bg-white shadow rounded">
            <div>Total</div>
            <div class="text-3xl font-bold">
                {{ $stats['total'] }}
            </div>
        </div>

        <div class="p-4 bg-white shadow rounded">
            <div>Pending</div>
            <div class="text-3xl font-bold">
                {{ $stats['pending'] }}
            </div>
        </div>

        <div class="p-4 bg-white shadow rounded">
            <div>Confirmed</div>
            <div class="text-3xl font-bold">
                {{ $stats['confirmed'] }}
            </div>
        </div>

        <div class="p-4 bg-white shadow rounded">
            <div>Checked In</div>
            <div class="text-3xl font-bold">
                {{ $stats['checked_in'] }}
            </div>
        </div>

    </div>

    <table class="w-full border">

        <thead>
            <tr>
                <th>Hostel</th>
                <th>Room</th>
                <th>Bed</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>

        <tbody>

            @foreach($bookings as $booking)

            <tr>

                <td>{{ $booking->hostel->name }}</td>

                <td>{{ $booking->room->name }}</td>

                <td>{{ $booking->bed->bed_number }}</td>

                <td>{{ $booking->status->value }}</td>

                <td>

                    @if($booking->status === \App\Enums\Booking\BookingStatusEnum::AWAITING_ACCEPTANCE)

                        <form
                            method="POST"
                            action="{{ route('seeker.bookings.accept',$booking) }}"
                            class="inline"
                        >
                            @csrf
                            @method('PATCH')

                            <button class="px-3 py-1 bg-green-500 text-white rounded">
                                Accept
                            </button>

                        </form>

                        <form
                            method="POST"
                            action="{{ route('seeker.bookings.reject',$booking) }}"
                            class="inline"
                        >
                            @csrf
                            @method('PATCH')

                            <button class="px-3 py-1 bg-red-500 text-white rounded">
                                Reject
                            </button>

                        </form>

                    @endif

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

</x-app-layout>