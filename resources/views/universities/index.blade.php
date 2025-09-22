@extends('layout.app')

@section('content')
<div class="flex justify-between mb-4">
    <h1 class="text-2xl font-bold">Universities</h1>
    <a href="{{ route('universities.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add University</a>
</div>
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
        @foreach($universities as $uni)
        <tr class="border-b">
            <td class="px-4 py-2">{{ $uni->id }}</td>
            <td class="px-4 py-2">{{ $uni->name }}</td>
            <td class="px-4 py-2">{{ $uni->location }}</td>
            <td class="px-4 py-2 flex space-x-2">
                <a href="{{ route('universities.edit', $uni) }}" class="bg-yellow-400 px-2 py-1 rounded text-white">Edit</a>
                <form action="{{ route('universities.destroy', $uni) }}" method="POST" onsubmit="return confirm('Delete?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="bg-red-500 px-2 py-1 rounded text-white">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $universities->links('pagination::tailwind') }}

@endsection
