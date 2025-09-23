@extends('layout.app')
@section('content')
<div class="bg-white p-6 rounded shadow max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-4">Edit Faculty</h1>

    <form action="{{ route('faculties.update', $faculty) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Faculty Name -->
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Faculty Name</label>
            <input type="text" name="name" value="{{ $faculty->name }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <!-- University Select -->
        <div class="mb-4">
            <label class="block mb-1 font-semibold">University</label>
            <select name="university_id" id="university-select" class="w-full border px-3 py-2 rounded" required>
                <option value="">Select University</option>
                @foreach($universities as $university)
                    <option value="{{ $university->id }}" {{ $faculty->university_id == $university->id ? 'selected' : '' }}>
                        {{ $university->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-semibold transition">
            Update
        </button>
    </form>
</div>

<!-- Include your JS library for searchable dropdown -->
<script>
    // Example for Select2
    $(document).ready(function() {
        $('#university-select').select2({
            placeholder: "Select a University",
            allowClear: true
        });
    });
</script>
@endsection
