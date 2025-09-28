<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-200">Edit Profile</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                       class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">Lastname</label>
                <input type="text" name="lastname" value="{{ old('lastname', $user->lastname) }}"
                       class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">Profile Photo</label>
                <input type="file" name="profile_photo" class="w-full">
                @if($user->profile_photo)
                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile"
                         class="w-16 h-16 rounded-full mt-2">
                @endif
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Update
            </button>
        </form>
    </div>
</x-app-layout>
