<x-app-layout>
<div class="p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Courses</h1>
        <a href="{{ route('courses.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Add New Course</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Code</th>
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-left">Faculty</th>
                    <th class="p-3 text-left">Department</th>
                    <th class="p-3 text-left">Credit Hours</th>
                    <th class="p-3 text-left">Teachers</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($courses as $course)
                <tr class="hover:bg-gray-50">
                    <td class="p-3">{{ $course->code }}</td>
                    <td class="p-3">{{ $course->name }}</td>
                    <td class="p-3">{{ $course->faculty->name ?? '-' }}</td>
                    <td class="p-3">{{ $course->department->name ?? '-' }}</td>
                    <td class="p-3">{{ $course->credit_hours }}</td>
                    <td class="p-3">{{ $course->teachers->pluck('name')->join(', ') ?: '-' }}</td>
                    <td class="p-3 space-x-2">
                        <a href="{{ route('courses.edit', $course->id) }}" class="bg-yellow-400 px-3 py-1 rounded text-white hover:bg-yellow-500">Edit</a>
                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 px-3 py-1 rounded text-white hover:bg-red-600" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $courses->links() }}
        </div>
    </div>

</div>
</x-app-layout>
