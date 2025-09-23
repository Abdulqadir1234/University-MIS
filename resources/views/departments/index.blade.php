@extends('layout.app')
@section('content')
<div class="flex justify-between mb-4">
<h1 class="text-2xl font-bold">Departments</h1>
<a href="{{ route('departments.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Department</a>
</div>
<table class="w-full bg-white rounded shadow overflow-hidden">
<thead class="bg-gray-100">
<tr>
<th class="px-4 py-2">ID</th>
<th class="px-4 py-2">Name</th>
<th class="px-4 py-2">University</th>
<th class="px-4 py-2">Faculty</th>
<th class="px-4 py-2">Actions</th>
</tr>
</thead>
<tbody>
@foreach($departments as $dep)
<tr class="border-b">
<td class="px-4 py-2">{{ $dep->id }}</td>
<td class="px-4 py-2">{{ $dep->name }}</td>
<td class="px-4 py-2">{{ $dep->university->name }}</td>
<td class="px-4 py-2">{{ $dep->faculty->name }}</td>
<td class="px-4 py-2 flex space-x-2">
<a href="{{ route('departments.edit', $dep) }}" class="bg-yellow-400 px-2 py-1 rounded text-white">Edit</a>
<form action="{{ route('departments.destroy', $dep) }}" method="POST" onsubmit="return confirm('Delete?')">
@csrf @method('DELETE')
<button type="submit" class="bg-red-500 px-2 py-1 rounded text-white">Delete</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>
 <div class="mt-4">
        {{ $departments->links('pagination::tailwind') }}
    </div>
@endsection
