<x-app-layout>

<form method="POST" action="{{ route('owner.bookings.store') }}">

    @csrf

    <input name="hostel_id" placeholder="Hostel ID">
    <input name="room_id" placeholder="Room ID">
    <input name="bed_id" placeholder="Bed ID">
    <hr>
    <div>
        <label>Existing Seeker</label>
        <select name="seeker_id">
            <option value="">Walk-in Seeker</option>
            @foreach($seekers as $seeker)
                <option value="{{ $seeker->id }}">
                    {{ $seeker->name }}
                    ({{ $seeker->email }})
                </option>
            @endforeach
        </select>
    </div>
    <input name="name" placeholder="Name">
    <input name="email" placeholder="Email">
    <input name="phone" placeholder="Phone">
    <input name="cnic" placeholder="CNIC">
    <hr>

    <input type="date" name="check_in_date">
    <input name="monthly_rent" placeholder="Rent">
    <button>Create Booking</button>
</form>

</x-app-layout>