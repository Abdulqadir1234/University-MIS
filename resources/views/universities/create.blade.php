@extends('layouts.app')
@section('title','Add University')
@section('content')

<h1 class="text-2xl font-bold text-pink-700 mb-4">Add University</h1>

<form action="{{ route('universities.store') }}" method="POST" class="bg-white p-6 rounded shadow">
    @csrf
    <div class="mb-4">
        <label class="block mb-1 font-semibold">Name</label>
        <input type="text" name="name" value="{{ old('name') }}" class="w-full border px-3 py-2 rounded" required>
        @error('name')<p class="text-red-500 mt-1">{{ $message }}</p>@enderror
    </div>
    <div class="mb-4">
        <label class="block mb-1 font-semibold">Location</label>
        <input type="text" name="location" value="{{ old('location') }}" class="w-full border px-3 py-2 rounded">
    </div>
    <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600">Create</button>
</form>

@endsection
