@extends('layout.app')
@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Add Faculty</h1>
    <form action="{{ route('faculties.store') }}" method="POST">
        @csrf

        <!-- Faculty Name -->
        <div class="mb-4">
            <label class="block mb-1">Faculty Name</label>
            <input type="text" name="name" class="w-full border px-3 py-2 rounded" required>
        </div>

        <!-- University Select -->
        <div class="mb-4">
            <label class="block mb-1">University</label>
            <select name="university_id" id="university-select" class="w-full border px-3 py-2 rounded" required>
                <option value="" disabled selected>Select University</option>
                @foreach($universities as $university)
                    <option value="{{ $university->id }}">{{ $university->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>

<!-- Initialize Select2 -->
<script>
    $(document).ready(function() {
        $('#university-select').select2({
            placeholder: "Select University",
            allowClear: true
        });
    });
</script>
@endsection
