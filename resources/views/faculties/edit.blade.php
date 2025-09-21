@extends('layouts.app')
@section('title','Edit Faculty')
@section('content')

<h1 class="text-2xl font-bold text-blue-700 mb-4">Edit Faculty</h1>

<form action="{{ route('faculties.update', $faculty->id) }}" method="POST" class="bg-white p-6 rounded shadow">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label class="block mb-1 font-semibold">Name</label>
        <input type="text" name="name" value="{{ old('name', $faculty->name) }}" class="w-full border px-3 py-2 rounded" required>
        @error('name')<p class="text-red-500 mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Department</label>
        <select name="department_id" class="w-full border px-3 py-2 rounded" required>
            <option value="">Select Department</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}" {{ (old('department_id', $faculty->department_id) == $department->id) ? 'selected' : '' }}>
                    {{ $department->name }} ({{ $department->university->name }})
                </option>
            @endforeach
        </select>
        @error('department_id')<p class="text-red-500 mt-1">{{ $message }}</p>@enderror
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
</form>

@endsection
