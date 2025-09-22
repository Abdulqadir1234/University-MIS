@extends('layout.app')
@section('content')
<div class="bg-white p-6 rounded shadow">
<h1 class="text-2xl font-bold mb-4">Edit University</h1>
<form action="{{ route('universities.update', $university) }}" method="POST">
@csrf @method('PUT')
<div class="mb-4">
<label class="block mb-1">Name</label>
<input type="text" name="name" value="{{ $university->name }}" class="w-full border px-3 py-2 rounded" required>
</div>
<div class="mb-4">
<label class="block mb-1">Location</label>
<input type="text" name="location" value="{{ $university->location }}" class="w-full border px-3 py-2 rounded">
</div>
<button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
</form>
</div>
@endsection
