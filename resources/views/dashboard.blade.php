@extends('layout.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Universities Card -->
    <div class="bg-gradient-to-r from-gray-800 to-gray-900 text-white p-6 rounded-2xl shadow-2xl transform hover:scale-105 transition duration-300 relative overflow-hidden">
        <!-- Book Icon -->
        <svg class="w-16 h-16 absolute top-4 right-4 opacity-20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m4 6H4a2 2 0 01-2-2V6a2 2 0 012-2h16a2 2 0 012 2v12a2 2 0 01-2 2z"/>
        </svg>
        <h2 class="text-xl font-bold mb-2">Universities</h2>
        <p class="text-4xl font-extrabold">{{ \App\Models\University::count() }}</p>
        <a href="{{ route('universities.index') }}" class="mt-4 inline-block bg-indigo-600 text-white px-4 py-2 rounded-lg font-semibold shadow hover:bg-indigo-700 transition">View All</a>
    </div>

    <!-- Faculties Card -->
    <div class="bg-gradient-to-r from-gray-700 to-gray-800 text-white p-6 rounded-2xl shadow-2xl transform hover:scale-105 transition duration-300 relative overflow-hidden">
        <!-- Book Icon -->
        <svg class="w-16 h-16 absolute top-4 right-4 opacity-20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m4 6H4a2 2 0 01-2-2V6a2 2 0 012-2h16a2 2 0 012 2v12a2 2 0 01-2 2z"/>
        </svg>
        <h2 class="text-xl font-bold mb-2">Faculties</h2>
        <p class="text-4xl font-extrabold">{{ \App\Models\Faculty::count() }}</p>
        <a href="{{ route('faculties.index') }}" class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded-lg font-semibold shadow hover:bg-green-700 transition">View All</a>
    </div>

    <!-- Departments Card -->
    <div class="bg-gradient-to-r from-gray-600 to-gray-700 text-white p-6 rounded-2xl shadow-2xl transform hover:scale-105 transition duration-300 relative overflow-hidden">
        <!-- Book Icon -->
        <svg class="w-16 h-16 absolute top-4 right-4 opacity-20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m4 6H4a2 2 0 01-2-2V6a2 2 0 012-2h16a2 2 0 012 2v12a2 2 0 01-2 2z"/>
        </svg>
        <h2 class="text-xl font-bold mb-2">Departments</h2>
        <p class="text-4xl font-extrabold">{{ \App\Models\Department::count() }}</p>
        <a href="{{ route('departments.index') }}" class="mt-4 inline-block bg-pink-600 text-white px-4 py-2 rounded-lg font-semibold shadow hover:bg-pink-700 transition">View All</a>
    </div>
</div>
@endsection
