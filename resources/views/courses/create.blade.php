<x-app-layout>
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">

    <h1 class="text-2xl font-bold mb-4">Add New Course</h1>

    <form action="{{ route('courses.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1">Course Code</label>
            <input type="text" name="code" value="{{ old('code') }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div>
            <label class="block mb-1">Course Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div>
            <label class="block mb-1">Faculty</label>
            <select name="faculty_id" class="w-full border px-3 py-2 rounded">
                <option value="">Select Faculty</option>
                @foreach($faculties as $faculty)
                    <option value="{{ $faculty->id }}" {{ old('faculty_id')==$faculty->id ? 'selected' : '' }}>{{ $faculty->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1">Department</label>
            <select name="department_id" class="w-full border px-3 py-2 rounded">
                <option value="">Select Department</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ old('department_id')==$department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1">Credit Hours</label>
            <input type="number" name="credit_hours" value="{{ old('credit_hours') }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div>
            <label class="block mb-1">Description</label>
            <textarea name="description" rows="3" class="w-full border px-3 py-2 rounded">{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="block mb-1">Assign Teachers</label>
            <select name="teachers[]" multiple class="w-full border px-3 py-2 rounded">
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                @endforeach
            </select>
            <p class="text-sm text-gray-500 mt-1">Hold Ctrl (Windows) or Cmd (Mac) to select multiple teachers.</p>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save Course</button>
    </form>

</div>
</x-app-layout>
