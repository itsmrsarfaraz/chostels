<x-app-layout>
    <h1>{{ $hostel->name }}</h1>
    <p>{{ $hostel->address }}</p>
    <hr>
    <h2>Rooms</h2>
    @foreach($hostel->rooms as $room)
        <div>
            <h4>{{ $room->name }}</h4>
            <p>Rent: {{ $room->monthly_rent }}</p>
            <p>Total Beds: {{ $room->total_beds }}</p>
        </div>
    @endforeach
</x-app-layout>