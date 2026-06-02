<x-app-layout>

<a href="{{ route('owner.hostels.create') }}">
    Create Hostel
</a>

@foreach($hostels as $hostel)

<div>
    {{ $hostel->name }}
</div>

@endforeach

</x-app-layout>