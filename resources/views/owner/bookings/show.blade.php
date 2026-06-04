@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Booking Details</h1>
    <hr>
    <h3>Seeker</h3>
    <p>Name: {{ $booking->seeker->name }}</p>
    <p>Email: {{ $booking->seeker->email }}</p>
    <hr>
    <h3>Hostel</h3>
    <p>{{ $booking->hostel->name }}</p>
    <p>Room: {{ $booking->room->name }}</p>
    <p>Bed: {{ $booking->bed->bed_number }}</p>
    <hr>
    <h3>Booking</h3>
    <p>Status: {{ $booking->status->value }}</p>
    <p>Source: {{ $booking->source->value }}</p>
    <p>Check In: {{ $booking->check_in_date }}</p>
    <p>Check Out: {{ $booking->check_out_date }}</p>
    <p>Rent: Rs. {{ number_format($booking->monthly_rent) }}</p>

</div>
@endsection