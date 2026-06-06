<x-app-layout>

<div class="max-w-7xl mx-auto py-8">

    @if ($errors->any())
        <div>
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if(session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-3xl font-bold mb-6">{{ $hostel->name }}</h1>
    <p>{{ $hostel->address }}</p>
    <p>{{ $hostel->description }}</p>

    @foreach($hostel->rooms as $room)
        <div class="border p-4 mb-4">
            <h2>{{ $room->name }}</h2>
            <p>Capacity: {{ $room->capacity }}</p>
            <table>
                <thead>
                    <tr>
                        <th>Bed</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($room->beds as $bed)
                        <tr>
                            <td>{{ $bed->bed_number }}</td>

                            <td>{{ $bed->status->value }}</td>

                            <td>
                                @if($bed->status == \App\Enums\BedStatus::Available)
                                    <form method="POST" action="{{ route('seeker.booking-requests.store') }}">
                                        @csrf
                                        <input type="hidden" name="hostel_id" value="{{ $hostel->id }}">
                                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                                        <input type="hidden" name="bed_id" value="{{ $bed->id }}">
                                        <div>
                                            <label>Check In Date</label>
                                            <input type="date" name="check_in_date" required>
                                        </div>
                                        <div>
                                            <label>Monthly Rent</label>
                                            <input type="number" step="0.01" name="monthly_rent" value="{{ $bed->monthly_rent ?? 0 }}" required>
                                        </div>
                                        <button type="submit">Request Booking</button>
                                    </form>
                                @else
                                    <span class="text-gray-500">Not Available</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
</div>
</x-app-layout>