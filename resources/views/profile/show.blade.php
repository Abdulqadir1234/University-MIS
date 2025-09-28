<x-app-layout>
    <div class="max-w-3xl mx-auto p-6">
        <h2 class="text-2xl font-bold mb-6">Your Profile</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PATCH')

            <!-- Profile Picture -->
            <div class="flex items-center space-x-4">
                <img src="{{ asset('storage/' . ($user->profile_photo ?? 'default.png')) }}" alt="Profile"
                     class="w-24 h-24 rounded-full object-cover">
                <input type="file" name="profile_photo" class="border rounded p-2 w-full">
            </div>

            <!-- Name -->
            <div>
                <label class="block font-medium mb-1">First Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                       class="w-full border rounded p-2">
            </div>

            <!-- Last Name -->
            <div>
                <label class="block font-medium mb-1">Last Name</label>
                <input type="text" name="lastname" value="{{ old('lastname', $user->lastname) }}" 
                       class="w-full border rounded p-2">
            </div>

            <!-- Email -->
            <div>
                <label class="block font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                       class="w-full border rounded p-2">
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Update Profile
            </button>
        </form>
    </div>
</x-app-layout>
