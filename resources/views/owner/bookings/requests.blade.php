<x-app-layout>
    <h1>Booking Requests</h1>

    @if($bookings->isEmpty())
        <p>No booking requests found.</p>
    @endif
    @if($bookings->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>Seeker</th>
                    <th>Hostel</th>
                    <th>Room</th>
                    <th>Bed</th>
                    <th>Check In</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>
                            {{ $booking->seeker->name }}
                            <br>
                            {{ $booking->seeker->email }}
                        </td>
                        <td>{{ $booking->hostel->name }}</td>
                        <td>{{ $booking->room->name }}</td>
                        <td>{{ $booking->bed->bed_number }}</td>
                        <td>{{ $booking->check_in_date }}</td>
                        <td>{{ $booking->status->value }}</td>
                        <td>
                            <form
                                method="POST"
                                action="{{ route('owner.bookings.approve-request',$booking) }}"
                                class="inline"
                            >
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded">
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
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">
                                    Reject
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        {{ $bookings->links() }}
    @endif
</x-app-layout>