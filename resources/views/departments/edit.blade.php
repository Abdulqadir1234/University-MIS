@extends('layouts.app')
@section('title','Edit Department')
@section('content')

<h1 class="text-2xl font-bold text-green-700 mb-4">Edit Department</h1>

<form action="{{ route('departments.update', $department->id) }}" method="POST" class="bg-white p-6 rounded shadow">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label class="block mb-1 font-semibold">Name</label>
        <input type="text" name="name" value="{{ old('name', $department->name) }}" class="w-full border px-3 py-2 rounded" required>
        @error('name')<p class="text-red-500 mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">University</label>
        <select name="university_id" class="w-full border px-3 py-2 rounded" required>
            <option value="">Select University</option>
            @foreach($universities as $university)
                <option value="{{ $university->id }}" {{ (old('university_id', $department->university_id) == $university->id) ? 'selected' : '' }}>{{ $university->name }}</option>
            @endforeach
        </select>
        @error('university_id')<p class="text-red-500 mt-1">{{ $message }}</p>@enderror
    </div>

    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Update</button>
</form>

@endsection
