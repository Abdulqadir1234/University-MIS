@extends('layout.app')
@section('content')
<div class="bg-white p-6 rounded shadow max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-4">Edit Department</h1>

    <form action="{{ route('departments.update', $department) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Department Name -->
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Department Name</label>
            <input type="text" name="name" value="{{ $department->name }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <!-- University Select -->
        <div class="mb-4">
            <label class="block mb-1 font-semibold">University</label>
            <select name="university_id" id="university-select" class="w-full border px-3 py-2 rounded" required>
                <option value="">Select University</option>
                @foreach($universities as $university)
                    <option value="{{ $university->id }}" {{ $department->university_id == $university->id ? 'selected' : '' }}>
                        {{ $university->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Faculty Select -->
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Faculty</label>
            <select name="faculty_id" id="faculty-select" class="w-full border px-3 py-2 rounded" required>
                <option value="">Select Faculty</option>
                @foreach($faculties as $faculty)
                    <option value="{{ $faculty->id }}" data-university="{{ $faculty->university_id }}"
                        {{ $department->faculty_id == $faculty->id ? 'selected' : '' }}>
                        {{ $faculty->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-semibold transition">
            Update
        </button>
    </form>
</div>

<!-- JS Library Initialization (e.g., Select2) -->
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('#university-select').select2({ placeholder: "Select a University", allowClear: true });
        $('#faculty-select').select2({ placeholder: "Select a Faculty", allowClear: true });

        // Filter faculties when university changes
        $('#university-select').on('change', function() {
            var selectedUniversity = $(this).val();

            $('#faculty-select option').each(function() {
                var uniId = $(this).data('university');
                $(this).toggle(uniId == selectedUniversity || $(this).val() == "");
            });

            $('#faculty-select').val('').trigger('change'); // reset faculty
        });

        // Trigger change on page load to filter faculties based on current university
        $('#university-select').trigger('change');
    });
</script>
@endsection
