@extends('layouts.app')
@section('title','Universities')
@section('content')

<h1 class="text-2xl font-bold text-blue-700 mb-4">Universities</h1>
<a href="{{ route('universities.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add University</a>

<table class="w-full mt-4 border bg-white">
    <thead>
        <tr class="bg-blue-100">
            <th class="px-4 py-2">ID</th>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($universities as $university)
        <tr>
            <td class="border px-4 py-2">{{ $university->id }}</td>
            <td class="border px-4 py-2">{{ $university->name }}</td>
            <td class="border px-4 py-2">
                <a href="{{ route('universities.edit',$university) }}" class="bg-yellow-400 px-2 py-1 rounded">Edit</a>
                <form action="{{ route('universities.destroy',$university) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button class="bg-red-500 px-2 py-1 rounded text-white">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $universities->links() }}
@endsection
