<x-app-layout>

    <div class="max-w-2xl mx-auto p-6">

        <h1 class="text-2xl font-bold mb-6">
            Complete Profile
        </h1>

        <form method="POST" action="{{ route('profile.complete.store') }}" class="space-y-4">
            @csrf

            <div>
                <label>Phone</label>
                <input type="text" name="phone" class="border rounded w-full">
            </div>

            <div>
                <label>CNIC</label>
                <input type="text" name="cnic" class="border rounded w-full">
            </div>

            <div>
                <label>Gender</label>
                <select name="gender" class="border rounded w-full">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <button type="submit" class="px-4 py-2 bg-black text-white">
                Save
            </button>

        </form>

    </div>

</x-app-layout>