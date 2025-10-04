<x-app-layout>
<div 
    x-data="{ isRtl: false, showProfileModal: false }" 
    :dir="isRtl ? 'rtl' : 'ltr'" 
    class="flex min-h-screen transition-all duration-500 bg-gray-100 dark:bg-gray-900">

    <!-- Sidebar -->
    <aside class="bg-gray-800 text-white w-64 min-h-screen p-6 transition-all duration-500" :class="{'rtl': isRtl}">
        <!-- Profile card -->
        @auth
        <div 
            @click="showProfileModal = true" 
            class="flex items-center space-x-4 mb-6 hover:bg-gray-700 p-2 rounded transition cursor-pointer">
            
            <img 
                src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('images/default.png') }}" 
                alt="Profile" 
                class="w-12 h-12 rounded-full object-cover">
            
            <div>
                <p class="font-bold text-lg">{{ Auth::user()->name }} {{ Auth::user()->lastname ?? '' }}</p>
                <p class="text-sm text-gray-300">{{ Auth::user()->getRoleNames()->first() ?? 'No Role' }}</p>
            </div>
        </div>
        @endauth

        <!-- Sidebar Links -->
        <ul class="space-y-4">
            @role('admin')
            <li><a href="{{ route('universities.index') }}" class="block p-2 rounded hover:bg-gray-700">Universities</a></li>
            @endrole

            @role('admin|teacher')
            <li><a href="{{ route('faculties.index') }}" class="block p-2 rounded hover:bg-gray-700">Faculties</a></li>
            @endrole

            @role('admin|teacher|student')
            <li><a href="{{ route('departments.index') }}" class="block p-2 rounded hover:bg-gray-700">Departments</a></li>
            @endrole
        </ul>

        <!-- Language / Direction Toggle -->
        <div class="mt-10">
            <button 
                @click="isRtl = !isRtl" 
                class="bg-blue-500 hover:bg-blue-600 px-3 py-2 rounded w-full transition">
                <span x-text="isRtl ? 'English' : 'فارسی'"></span>
            </button>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 p-6 transition-all duration-500">
        <!-- Logout -->
        @auth
        <div class="flex justify-end mb-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                    Logout
                </button>
            </form>
        </div>
        @endauth

        <!-- Welcome Message -->
        @auth
        <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6 text-gray-900 dark:text-gray-100">
            <p class="text-lg font-medium">
                You are logged in as <strong>{{ Auth::user()->getRoleNames()->first() ?? 'User' }}</strong>.
            </p>
        </div>
        @endauth

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            @role('admin')
            <div class="bg-indigo-500 text-white p-6 rounded shadow hover:shadow-lg transition duration-300">
                <h2 class="text-xl font-bold mb-2">Universities</h2>
                <p class="text-3xl">{{ \App\Models\University::count() }}</p>
                <a href="{{ route('universities.index') }}" class="text-blue-200 mt-2 inline-block hover:underline">View All</a>
            </div>
            @endrole

            @role('admin|teacher')
            <div class="bg-green-500 text-white p-6 rounded shadow hover:shadow-lg transition duration-300">
                <h2 class="text-xl font-bold mb-2">Faculties</h2>
                <p class="text-3xl">{{ \App\Models\Faculty::count() }}</p>
                <a href="{{ route('faculties.index') }}" class="text-blue-200 mt-2 inline-block hover:underline">View All</a>
            </div>
            @endrole

            @role('admin|teacher|student')
            <div class="bg-yellow-500 text-white p-6 rounded shadow hover:shadow-lg transition duration-300">
                <h2 class="text-xl font-bold mb-2">Departments</h2>
                <p class="text-3xl">{{ \App\Models\Department::count() }}</p>
                <a href="{{ route('departments.index') }}" class="text-blue-200 mt-2 inline-block hover:underline">View All</a>
            </div>
            @endrole
        </div>
    </div>

    <!-- Profile Modal -->
    @auth
    <div 
        x-show="showProfileModal" 
        x-transition 
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" 
        x-cloak>
        
        <div class="bg-white dark:bg-gray-900 rounded-lg p-6 w-96 relative">
            <!-- Close -->
            <button @click="showProfileModal = false" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-2xl">&times;</button>

            <!-- Profile -->
            <div class="flex flex-col items-center mb-4">
                <img 
                    src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('images/default.png') }}" 
                    class="w-32 h-32 rounded-full object-cover mb-4">
                <h2 class="text-xl font-bold">{{ Auth::user()->name }} {{ Auth::user()->lastname ?? '' }}</h2>
                <p class="text-gray-500">{{ Auth::user()->getRoleNames()->first() ?? 'No Role' }}</p>
            </div>

            <!-- Edit Form -->
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-gray-700 dark:text-gray-200">Name</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full px-3 py-2 rounded border">
                </div>

                <div>
                    <label class="block text-gray-700 dark:text-gray-200">Lastname</label>
                    <input type="text" name="lastname" value="{{ Auth::user()->lastname ?? '' }}" class="w-full px-3 py-2 rounded border">
                </div>

                <div>
                    <label class="block text-gray-700 dark:text-gray-200">Profile Photo</label>
                    <input type="file" name="profile_photo" class="w-full px-3 py-2 rounded border">
                </div>

                <div class="flex justify-between">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Update</button>
                    <button type="button" @click="showProfileModal = false" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    @endauth
</div>
</x-app-layout>
