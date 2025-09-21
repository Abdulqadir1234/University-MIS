@extends('layouts.app')
@section('title','Departments')
@section('content')

<h1 class="text-2xl font-bold mb-4">Departments</h1>
<a href="{{ route('departments.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Add Department</a>

<table class="w-full mt-4 border bg-white">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2 border">ID</th>
            <th class="px-4 py-2 border">Name</th>
            <th class="px-4 py-2 border">University</th>
            <th class="px-4 py-2 border">Faculty</th>
            <th class="px-4 py-2 border">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($departments as $dept)
        <tr>
            <td class="border px-4 py-2">{{ $dept->id }}</td>
            <td class="border px-4 py-2">{{ $dept->name }}</td>
            <td class="border px-4 py-2">{{ $dept->university->name }}</td>
            <td class="border px-4 py-2">{{ $dept->faculty->name }}</td>
            <td class="border px-4 py-2">
                <a href="{{ route('departments.edit',$dept) }}" class="bg-yellow-400 px-3 py-1 rounded">Edit</a>
                <form action="{{ route('departments.destroy',$dept) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button class="bg-red-500 px-3 py-1 rounded text-white">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $departments->links() }}
</div>
@endsection
