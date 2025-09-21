@extends('layouts.app')
@section('title','Faculties')
@section('content')

<h1 class="text-2xl font-bold mb-4">Faculties</h1>
<a href="{{ route('faculties.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Add Faculty</a>

<table class="w-full mt-4 border bg-white">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2 border">ID</th>
            <th class="px-4 py-2 border">Name</th>
            <th class="px-4 py-2 border">University</th>
            <th class="px-4 py-2 border">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($faculties as $faculty)
        <tr>
            <td class="border px-4 py-2">{{ $faculty->id }}</td>
            <td class="border px-4 py-2">{{ $faculty->name }}</td>
            <td class="border px-4 py-2">{{ $faculty->university->name }}</td>
            <td class="border px-4 py-2">
                <a href="{{ route('faculties.edit',$faculty) }}" class="bg-yellow-400 px-3 py-1 rounded">Edit</a>
                <form action="{{ route('faculties.destroy',$faculty) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button class="bg-red-500 px-3 py-1 rounded text-white">Delete</button>
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
