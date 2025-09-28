@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Universities</h1>
    <a href="{{ route('universities.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600 transition">
        + Add University
    </a>
</div>

<!-- Search Bar -->
<!-- Search Bar -->
<form method="GET" action="{{ route('universities.index') }}" class="mb-4 flex items-center max-w-sm">
    <input type="text" 
           name="search" 
           placeholder="Search..."
           value="{{ request('search') }}"
           class="flex-1 border border-gray-300 px-2 py-1 rounded-l-md text-sm 
                  focus:outline-none focus:ring-1 focus:ring-blue-400 focus:border-blue-400 shadow-sm">
    <button type="submit" 
            class="bg-blue-500 text-white px-3 py-1 rounded-r-md text-sm 
                   hover:bg-blue-600 transition shadow-sm">
        🔍
    </button>
</form>


<!-- Table -->
<table class="w-full bg-white rounded shadow overflow-hidden">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-4 py-2">ID</th>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Location</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($universities as $uni)
        <tr class="border-b hover:bg-gray-50">
            <td class="px-4 py-2">{{ $uni->id }}</td>
            <td class="px-4 py-2 font-semibold">{{ $uni->name }}</td>
            <td class="px-4 py-2">{{ $uni->location }}</td>
            <td class="px-4 py-2 flex space-x-2">
                <a href="{{ route('universities.edit', $uni) }}" 
                   class="bg-yellow-400 px-2 py-1 rounded text-white hover:bg-yellow-500 transition">Edit</a>
                <form action="{{ route('universities.destroy', $uni) }}" method="POST" 
                      onsubmit="return confirm('Are you sure you want to delete this university?')">
                    @csrf @method('DELETE')
                    <button type="submit" 
                            class="bg-red-500 px-2 py-1 rounded text-white hover:bg-red-600 transition">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="px-4 py-2 text-center text-gray-500">No universities found.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<!-- Pagination -->
<div class="mt-4">
    {{ $universities->links('pagination::tailwind') }}
</div>
@endsection
