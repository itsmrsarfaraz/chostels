<x-app-layout>

<div class="max-w-7xl mx-auto py-8">

    <h1 class="text-2xl font-bold mb-6">
        Browse Hostels
    </h1>

    <div class="grid grid-cols-3 gap-6">

        @foreach($hostels as $hostel)

            <div class="border rounded p-4">

                <h2 class="font-bold">
                    {{ $hostel->name }}
                </h2>

                <p>{{ $hostel->address }}</p>

                <a href="{{ route('seeker.hostels.show',$hostel) }}" class="text-blue-600">
                    View Hostel
                </a>

            </div>

        @endforeach

    </div>

</div>

</x-app-layout>