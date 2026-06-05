<x-app-layout>

<div class="max-w-7xl mx-auto py-8">

    <h1 class="text-3xl font-bold mb-6">
        {{ $hostel->name }}
    </h1>

    @foreach($hostel->rooms as $room)

        <div class="border p-4 mb-4">

            <h2 class="font-bold">
                {{ $room->name }}
            </h2>

            <p>Rent: {{ $room->monthly_rent }}</p>

            @foreach($room->beds as $bed)

                <div class="border p-3 mt-2">

                    <strong>
                        {{ $bed->bed_number }}
                    </strong>

                    <form
                        action="{{ route('seeker.bookings.store') }}"
                        method="POST"
                        class="mt-3"
                    >
                        @csrf

                        <input type="hidden" name="hostel_id" value="{{ $hostel->id }}">
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        <input type="hidden" name="bed_id" value="{{ $bed->id }}">
                        <input type="hidden" name="monthly_rent" value="{{ $room->monthly_rent }}">

                        <input type="date" name="check_in_date" required>

                        <button class="bg-blue-600 text-white px-4 py-2 rounded">
                            Request Booking
                        </button>

                    </form>

                </div>

            @endforeach

        </div>

    @endforeach

</div>

</x-app-layout>