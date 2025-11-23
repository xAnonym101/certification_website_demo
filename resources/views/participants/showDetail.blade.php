<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $participant->full_name }} - Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body class="bg-gray-100 font-sans text-slate-800">
    <div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Student Profile</h1>
                <p class="mt-1 text-slate-500">Detailed records for this student.</p>
            </div>
            <a href="{{ route('participants.index') }}" class="text-slate-600 hover:text-slate-900 font-medium">
                <i class="fas fa-arrow-left mr-1"></i> Back to List
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-1">
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="bg-slate-800 p-6 text-center">
                        <div
                            class="h-24 w-24 mx-auto rounded-xl bg-teal-500 flex items-center justify-center text-3xl font-bold text-white mb-4">
                            {{ substr($participant->full_name, 0, 1) }}
                        </div>
                        <h2 id="view-name" class="text-xl font-bold text-white {{ $errors->any() ? 'hidden' : '' }}">
                            {{ $participant->full_name }}
                        </h2>
                        <h2 id="edit-name-label"
                            class="text-xl font-bold text-white {{ $errors->any() ? '' : 'hidden' }}">
                            Editing Profile...
                        </h2>
                        <p class="text-teal-200 text-sm">ID: #{{ $participant->participant_id }}</p>
                    </div>

                    <div class="p-6">
                        <div id="view-mode" class="{{ $errors->any() ? 'hidden' : '' }} space-y-4">
                            <div>
                                <label class="text-xs font-bold text-gray-400 uppercase">Email</label>
                                <p class="text-slate-700 font-medium break-all">{{ $participant->email }}</p>
                            </div>
                            <div>
                                <label class="text-xs font-bold text-gray-400 uppercase">Phone</label>
                                <p class="text-slate-700 font-medium">{{ $participant->phone_number }}</p>
                            </div>
                            <div>
                                <label class="text-xs font-bold text-gray-400 uppercase">Address</label>
                                <p class="text-slate-700 font-medium">{{ $participant->address }}</p>
                            </div>

                            <div class="pt-4 border-t border-gray-100">
                                <button onclick="toggleEditMode()" type="button"
                                    class="w-full text-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-slate-700 hover:bg-gray-50 transition">
                                    <i class="fas fa-edit mr-2"></i> Edit Profile
                                </button>
                            </div>
                        </div>
                        <form id="edit-mode" action="{{ route('participants.update', $participant->participant_id) }}"
                            method="POST" class="{{ $errors->any() ? '' : 'hidden' }} space-y-4">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="full_name" class="text-xs font-bold text-gray-400 uppercase">Full
                                    Name</label>
                                <input type="text" name="full_name" id="full_name" required
                                    value="{{ old('full_name', $participant->full_name) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm border p-2">
                                @error('full_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="email" class="text-xs font-bold text-gray-400 uppercase">Email</label>
                                <input type="email" name="email" id="email" required
                                    value="{{ old('email', $participant->email) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm border p-2">
                                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="phone_number"
                                    class="text-xs font-bold text-gray-400 uppercase">Phone</label>
                                <input type="text" name="phone_number" id="phone_number" required
                                    value="{{ old('phone_number', $participant->phone_number) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm border p-2">
                                @error('phone_number') <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="address" class="text-xs font-bold text-gray-400 uppercase">Address</label>
                                <textarea name="address" id="address" rows="3" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm border p-2">{{ old('address', $participant->address) }}</textarea>
                                @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div class="pt-4 border-t border-gray-100 flex gap-2">
                                <button type="submit"
                                    class="flex-1 justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                                    Save
                                </button>
                                <button onclick="toggleEditMode()" type="button"
                                    class="flex-1 justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-slate-700 bg-white hover:bg-gray-50 focus:outline-none">
                                    Cancel
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="md:col-span-2">
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-slate-50 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-slate-800">Enrolled Courses</h3>
                        <span class="bg-teal-100 text-teal-800 text-xs font-bold px-2.5 py-0.5 rounded-full">
                            {{ $participant->courses->count() }} Active
                        </span>
                    </div>

                    @if($participant->courses->count() > 0)
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Course Name</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Registration Date</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($participant->courses as $course)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('courses.show', $course->course_id) }}"
                                                class="text-sm font-bold text-teal-600 hover:underline">
                                                {{ $course->course_name }}
                                            </a>
                                            <div class="text-xs text-gray-500">{{ $course->instructor_name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $course->pivot->registration_date }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form
                                                action="{{ route('enrollments.destroy', ['course' => $course->course_id, 'participant' => $participant->participant_id]) }}"
                                                method="POST" onsubmit="return confirm('Drop this class?');"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-rose-500 hover:text-rose-700 text-xs font-bold uppercase">
                                                    Drop
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="p-8 text-center text-gray-500">
                            <i class="fas fa-folder-open text-4xl mb-3 text-gray-300"></i>
                            <p>This student has not enrolled in any classes yet.</p>
                            <a href="/courses" class="mt-2 inline-block text-teal-600 hover:text-teal-800 font-medium">Go to
                                Course Catalog &rarr;</a>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
    <script>
        function toggleEditMode() {
            const viewMode = document.getElementById('view-mode');
            const editMode = document.getElementById('edit-mode');
            const viewName = document.getElementById('view-name');
            const editNameLabel = document.getElementById('edit-name-label');

            if (viewMode.classList.contains('hidden')) {
                viewMode.classList.remove('hidden');
                editMode.classList.add('hidden');
                viewName.classList.remove('hidden');
                editNameLabel.classList.add('hidden');
            } else {
                viewMode.classList.add('hidden');
                editMode.classList.remove('hidden');
                viewName.classList.add('hidden');
                editNameLabel.classList.remove('hidden');
            }
        }
    </script>

</body>

</html>