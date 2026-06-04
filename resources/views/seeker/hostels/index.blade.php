<x-app-layout>
    <h1>Hostels</h1>
    @foreach($hostels as $hostel)
        <div>
            <h2>{{ $hostel->name }}</h2>
            <p>{{ $hostel->address }}</p>
            <a href="{{ route('seeker.hostels.show', $hostel) }}">View</a>
        </div>
    @endforeach
    {{ $hostels->links() }}
</x-app-layout>