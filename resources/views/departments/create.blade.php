@extends('layout.app')
@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Add Department</h1>
    <form action="{{ route('departments.store') }}" method="POST">
        @csrf

        <!-- Department Name -->
        <div class="mb-4">
            <label class="block mb-1">Department Name</label>
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

        <!-- Faculty Select -->
        <div class="mb-4">
            <label class="block mb-1">Faculty</label>
            <select name="faculty_id" id="faculty-select" class="w-full border px-3 py-2 rounded" required>
                <option value="" disabled selected>Select Faculty</option>
                @foreach($faculties as $faculty)
                    <option value="{{ $faculty->id }}" data-university="{{ $faculty->university_id }}">{{ $faculty->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>

<!-- Select2 JS Initialization -->
<script>
    $(document).ready(function() {
        // Initialize University select
        $('#university-select').select2({
            placeholder: "Select University",
            allowClear: true
        });

        // Initialize Faculty select
        $('#faculty-select').select2({
            placeholder: "Select Faculty",
            allowClear: true
        });

        // Filter faculties based on selected university
        $('#university-select').on('change', function() {
            var universityId = $(this).val();
            $('#faculty-select option').each(function() {
                var facultyUniId = $(this).data('university');
                if (!facultyUniId || facultyUniId == universityId) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
            $('#faculty-select').val(null).trigger('change'); // reset faculty select
        });
    });
</script>
@endsection
