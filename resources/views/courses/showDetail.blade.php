<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $course->course_name }} - Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body class="bg-gray-100 font-sans text-slate-800">

    <div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        <div class="mb-8 flex items-center justify-between">
            <div>
                <div id="view-header" class="{{ $errors->any() ? 'hidden' : '' }}">
                    <h1 class="text-3xl font-bold text-slate-900">{{ $course->course_name }}</h1>
                    <p class="mt-1 text-teal-600 font-medium">
                        <i class="fas fa-chalkboard-teacher mr-2"></i>Instructor: {{ $course->instructor_name }}
                    </p>
                </div>

                <div id="edit-header" class="{{ $errors->any() ? '' : 'hidden' }}">
                    <h1 class="text-3xl font-bold text-slate-900">Editing Course...</h1>
                    <p class="mt-1 text-slate-500 font-medium">Update the details below.</p>
                </div>
            </div>

            <a href="{{ route('courses.index') }}" class="text-slate-600 hover:text-slate-900 font-medium">
                <i class="fas fa-arrow-left mr-1"></i> Back to Catalog
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white shadow rounded-lg p-6">
                    <div id="view-mode" class="{{ $errors->any() ? 'hidden' : '' }}">
                        <h3 class="text-lg font-bold text-slate-800 mb-4">About this Course</h3>
                        <p class="text-slate-600 leading-relaxed">{{ $course->course_description }}</p>

                        <div class="mt-6 grid grid-cols-2 gap-4 text-sm">
                            <div class="bg-slate-50 p-3 rounded border border-slate-200">
                                <span class="block text-slate-400 text-xs uppercase font-bold">Start Date</span>
                                <span class="font-medium">{{ $course->start_date ?? 'TBA' }}</span>
                            </div>
                            <div class="bg-slate-50 p-3 rounded border border-slate-200">
                                <span class="block text-slate-400 text-xs uppercase font-bold">End Date</span>
                                <span class="font-medium">{{ $course->end_date ?? 'TBA' }}</span>
                            </div>
                        </div>
                    </div>
                    <form id="edit-mode" action="{{ route('courses.update', $course->course_id) }}" method="POST"
                        class="{{ $errors->any() ? '' : 'hidden' }} space-y-5">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="course_name" class="block text-sm font-medium text-slate-700">Course
                                Name</label>
                            <input type="text" name="course_name" id="course_name" required
                                value="{{ old('course_name', $course->course_name) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm border p-2">
                            @error('course_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="instructor_name" class="block text-sm font-medium text-slate-700">Instructor
                                Name</label>
                            <input type="text" name="instructor_name" id="instructor_name" required
                                value="{{ old('instructor_name', $course->instructor_name) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm border p-2">
                            @error('instructor_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="course_description"
                                class="block text-sm font-medium text-slate-700">Description</label>
                            <textarea name="course_description" id="course_description" rows="4" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm border p-2">{{ old('course_description', $course->course_description) }}</textarea>
                            @error('course_description') <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-slate-700">Start
                                    Date</label>
                                <input type="date" name="start_date" id="start_date"
                                    value="{{ old('start_date', $course->start_date) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm border p-2">
                                @error('start_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-slate-700">End Date</label>
                                <input type="date" name="end_date" id="end_date"
                                    value="{{ old('end_date', $course->end_date) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm border p-2">
                                @error('end_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="flex gap-3 pt-2">
                            <button type="submit"
                                class="flex-1 justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none">
                                Save Changes
                            </button>
                            <button type="button" onclick="toggleEditMode()"
                                class="flex-1 justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-slate-700 bg-white hover:bg-gray-50 focus:outline-none">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-slate-50">
                        <h3 class="text-lg font-bold text-slate-800">Enrolled Students
                            ({{ $course->participants->count() }})</h3>
                    </div>
                    <ul class="divide-y divide-gray-200">
                        @forelse($course->participants as $student)
                            <li class="px-6 py-4 flex items-center justify-between hover:bg-gray-50">
                                <div class="flex items-center">
                                    <div
                                        class="h-10 w-10 rounded bg-teal-100 text-teal-600 flex items-center justify-center font-bold mr-4">
                                        {{ substr($student->full_name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-slate-900">{{ $student->full_name }}</div>
                                        <p class="text-xs text-slate-500">Registered:
                                            {{ $student->pivot->registration_date }}</p>
                                    </div>
                                </div>
                                <form
                                    action="{{ route('enrollments.destroy', ['course' => $course->course_id, 'participant' => $student->participant_id]) }}"
                                    method="POST"
                                    onsubmit="return confirm('Remove {{ $student->full_name }} from this class?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-500 hover:text-rose-700 text-sm font-medium">
                                        Remove
                                    </button>
                                </form>
                            </li>
                        @empty
                            <li class="px-6 py-8 text-center text-slate-500 italic">
                                No students enrolled yet.
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="space-y-8">
                <div class="bg-white shadow rounded-lg p-6 border-t-4 border-teal-500">
                    <h3 class="text-lg font-bold text-slate-800 mb-4">Register New Student</h3>
                    <form action="{{ route('enrollments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $course->course_id }}">
                        <div class="mb-4">
                            <div class="mb-4 relative">
                                <label class="block text-sm font-medium text-slate-700 mb-2">Select Student</label>
                                <div class="relative">
                                    <select name="participant_id"
                                        class="appearance-none block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm border p-2 pr-10">
                                        <option value="" disabled selected>-- Choose a student --</option>
                                        @foreach($availableParticipants as $p)
                                            <option value="{{ $p->participant_id }}">{{ $p->full_name }}</option>
                                        @endforeach
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-500">
                                        <i class="fas fa-chevron-down text-xs"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none">
                            Enroll Student
                        </button>
                    </form>
                    <p class="mt-4 text-xs text-slate-400 text-center">
                        Only showing students not currently enrolled.
                    </p>
                </div>
                <div class="bg-white shadow rounded-lg p-6">
                    <button id="sidebar-edit-btn" onclick="toggleEditMode()" type="button"
                        class="{{ $errors->any() ? 'hidden' : '' }} w-full text-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-slate-700 hover:bg-gray-50 mb-3">
                        <i class="fas fa-edit mr-2"></i> Edit Course Details
                    </button>

                    <p id="sidebar-edit-msg"
                        class="{{ $errors->any() ? '' : 'hidden' }} text-center text-sm text-teal-600 font-medium">
                        <i class="fas fa-pen-nib mr-2"></i> Editing mode active
                    </p>
                </div>
            </div>

        </div>
    </div>
    <script>
        function toggleEditMode() {
            const viewHeader = document.getElementById('view-header');
            const editHeader = document.getElementById('edit-header');
            const viewMode = document.getElementById('view-mode');
            const editMode = document.getElementById('edit-mode');
            const sidebarBtn = document.getElementById('sidebar-edit-btn');
            const sidebarMsg = document.getElementById('sidebar-edit-msg');
            const elements = [viewHeader, editHeader, viewMode, editMode, sidebarBtn, sidebarMsg];
            elements.forEach(el => {
                if (el.classList.contains('hidden')) {
                    el.classList.remove('hidden');
                } else {
                    el.classList.add('hidden');
                }
            });
        }
    </script>
</body>

</html>