@extends('layouts.app')
@section('title','Faculties')
@section('content')

<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold text-blue-700">Faculties</h1>
    <a href="{{ route('faculties.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Faculty</a>
</div>

<table class="w-full border rounded shadow bg-white">
    <thead>
        <tr class="bg-blue-100">
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">Name</th>
            <th class="border px-4 py-2">University</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($faculties as $faculty)
        <tr class="hover:bg-blue-50">
            <td class="border px-4 py-2">{{ $faculty->id }}</td>
            <td class="border px-4 py-2">{{ $faculty->name }}</td>
            <td class="border px-4 py-2">
                {{ $faculty->university ? $faculty->university->name : 'N/A' }}
            </td>
            <td class="border px-4 py-2 flex gap-2">
                <a href="{{ route('faculties.edit', $faculty->id) }}" class="bg-yellow-400 text-white px-2 py-1 rounded hover:bg-yellow-500">Edit</a>
                <form action="{{ route('faculties.destroy', $faculty->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $faculties->links() }}
</div>

@endsection
