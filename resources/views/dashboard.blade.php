<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="space-x-2">
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                            Logout
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Welcome message with role -->
            @auth
                <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6 text-gray-900 dark:text-gray-100">
                    @php
                        $role = auth()->user()->getRoleNames()->first() ?? 'no role';
                    @endphp
                    <p class="text-lg font-medium">
                        You're logged in as <span class="font-bold text-blue-500">{{ $role }}</span>.
                    </p>
                </div>
            @endauth

            <!-- Stats cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                @auth
                    <div class="bg-gray-800 dark:bg-gray-700 text-white p-6 rounded shadow hover:shadow-lg transition duration-300">
                        <h2 class="text-xl font-bold mb-2">Universities</h2>
                        <p class="text-3xl">{{ \App\Models\University::count() }}</p>
                        <a href="{{ route('universities.index') }}" class="text-blue-400 mt-2 inline-block hover:underline">View All</a>
                    </div>
                    <div class="bg-gray-800 dark:bg-gray-700 text-white p-6 rounded shadow hover:shadow-lg transition duration-300">
                        <h2 class="text-xl font-bold mb-2">Faculties</h2>
                        <p class="text-3xl">{{ \App\Models\Faculty::count() }}</p>
                        <a href="{{ route('faculties.index') }}" class="text-blue-400 mt-2 inline-block hover:underline">View All</a>
                    </div>
                    <div class="bg-gray-800 dark:bg-gray-700 text-white p-6 rounded shadow hover:shadow-lg transition duration-300">
                        <h2 class="text-xl font-bold mb-2">Departments</h2>
                        <p class="text-3xl">{{ \App\Models\Department::count() }}</p>
                        <a href="{{ route('departments.index') }}" class="text-blue-400 mt-2 inline-block hover:underline">View All</a>
                    </div>
                @endauth
            </div>

            <!-- Optional role-specific message -->
            @auth
                @role('admin')
                    <div class="bg-green-100 text-green-800 p-4 rounded shadow-sm">
                        Welcome Admin! You can manage universities, faculties, and departments.
                    </div>
                @else
                    <div class="bg-yellow-100 text-yellow-800 p-4 rounded shadow-sm">
                        You are logged in as <strong>{{ $role }}</strong>. You have limited access.
                    </div>
                @endrole
            @endauth

        </div>
    </div>
</x-app-layout>
