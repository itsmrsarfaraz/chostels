<x-app-layout>

<form method="POST" action="{{ route('owner.hostels.store') }}" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" placeholder="Hostel Name">
    <input type="text" name="phone" placeholder="Phone">
    <input type="text" name="city" placeholder="City">
    <input type="text" name="address" placeholder="Address">
    <textarea name="description"></textarea>
    <input type="file" name="logo">
    <button type="submit">
        Create Hostel
    </button>
</form>

</x-app-layout>