@extends('layouts.app')
@section('title','Departments')
@section('content')

<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold text-green-700">Departments</h1>
    <a href="{{ route('departments.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add Department</a>
</div>

<table class="w-full border rounded shadow bg-white">
    <thead>
        <tr class="bg-green-100">
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">Name</th>
            <th class="border px-4 py-2">University</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($departments as $department)
        <tr class="hover:bg-green-50">
            <td class="border px-4 py-2">{{ $department->id }}</td>
            <td class="border px-4 py-2">{{ $department->name }}</td>
            <td class="border px-4 py-2">{{ $department->university->name }}</td>
            <td class="border px-4 py-2 flex gap-2">
                <a href="{{ route('departments.edit', $department->id) }}" class="bg-yellow-400 text-white px-2 py-1 rounded hover:bg-yellow-500">Edit</a>
                <form action="{{ route('departments.destroy', $department->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    {{ $departments->links() }}

</table>

@endsection
