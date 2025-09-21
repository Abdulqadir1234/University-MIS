@extends('layouts.app')
@section('title','Universities')
@section('content')

<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold text-pink-700">Universities</h1>
    <a href="{{ route('universities.create') }}" class="bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600">Add University</a>
</div>

<table class="w-full border rounded shadow bg-white">
    <thead>
        <tr class="bg-pink-100">
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">Name</th>
            <th class="border px-4 py-2">Location</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($universities as $university)
        <tr class="hover:bg-pink-50">
            <td class="border px-4 py-2">{{ $university->id }}</td>
            <td class="border px-4 py-2">{{ $university->name }}</td>
            <td class="border px-4 py-2">{{ $university->location }}</td>
            <td class="border px-4 py-2 flex gap-2">
                <a href="{{ route('universities.edit', $university->id) }}" class="bg-yellow-400 text-white px-2 py-1 rounded hover:bg-yellow-500">Edit</a>
                <form action="{{ route('universities.destroy', $university->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>


</table>
    {{ $universities->links() }}

@endsection
