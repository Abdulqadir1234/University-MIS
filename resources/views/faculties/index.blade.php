@extends('layout.app')
@section('content')
<div class="flex justify-between mb-4">
    <h1 class="text-2xl font-bold">Faculties</h1>
    <a href="{{ route('faculties.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Faculty</a>
</div>
<table class="w-full bg-white rounded shadow overflow-hidden">
<thead class="bg-gray-100">
<tr>
<th class="px-4 py-2">ID</th>
<th class="px-4 py-2">Name</th>
<th class="px-4 py-2">University</th>
<th class="px-4 py-2">Actions</th>
</tr>
</thead>
<tbody>
@foreach($faculties as $fac)
<tr class="border-b">
<td class="px-4 py-2">{{ $fac->id }}</td>
<td class="px-4 py-2">{{ $fac->name }}</td>
<td class="px-4 py-2">{{ $fac->university->name }}</td>
<td class="px-4 py-2 flex space-x-2">
<a href="{{ route('faculties.edit', $fac) }}" class="bg-yellow-400 px-2 py-1 rounded text-white">Edit</a>
<form action="{{ route('faculties.destroy', $fac) }}" method="POST" onsubmit="return confirm('Delete?')">
@csrf @method('DELETE')
<button type="submit" class="bg-red-500 px-2 py-1 rounded text-white">Delete</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>
{{ $faculties->links('pagination::tailwind') }}

@endsection
