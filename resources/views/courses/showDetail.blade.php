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
                <h1 class="text-3xl font-bold text-slate-900">{{ $course->course_name }}</h1>
                <p class="mt-1 text-teal-600 font-medium"><i class="fas fa-chalkboard-teacher mr-2"></i>Instructor:
                    {{ $course->instructor_name }}</p>
            </div>
            <a href="/courses" class="text-slate-600 hover:text-slate-900 font-medium">
                <i class="fas fa-arrow-left mr-1"></i> Back to List
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 space-y-8">

                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-bold text-slate-800 mb-4">About this Course</h3>
                    <p class="text-slate-600 leading-relaxed">{{ $course->course_description }}</p>
                    <div class="mt-6 grid grid-cols-2 gap-4 text-sm">
                        <div class="bg-slate-50 p-3 rounded border border-slate-200">
                            <span class="block text-slate-400 text-xs uppercase font-bold">Start Date</span>
                            <span class="font-medium">{{ $course->start_date }}</span>
                        </div>
                        <div class="bg-slate-50 p-3 rounded border border-slate-200">
                            <span class="block text-slate-400 text-xs uppercase font-bold">End Date</span>
                            <span class="font-medium">{{ $course->end_date }}</span>
                        </div>
                    </div>
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
                                        <p class="text-sm font-medium text-slate-900">{{ $student->full_name }}</p>
                                        <p class="text-xs text-slate-500">Registered:
                                            {{ $student->pivot->registration_date }}</p>
                                    </div>
                                </div>

                                <form
                                    action="{{ route('courses.discharge', ['course' => $course->course_id, 'participant' => $student->participant_id]) }}"
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

                    <form action="{{ route('courses.enroll', $course->course_id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <div class="mb-4 relative">
                                <label class="block text-sm font-medium text-slate-700 mb-2">Select Student</label>
                                
                                <div class="relative">
                                    <select name="participant_id" class="appearance-none block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm border p-2 pr-10">
                                        <option value="" disabled selected>-- Choose a student --</option>
                                        @foreach($availableParticipants as $p)
                                            <option value="{{ $p->participant_id }}">{{ $p->full_name }}</option>
                                        @endforeach
                                    </select>
                                    
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-500">
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
                        Only showing students not currently enrolled in this class.
                    </p>
                </div>

                <div class="bg-white shadow rounded-lg p-6">
                    <a href="{{ route('courses.edit', $course->course_id) }}"
                        class="block w-full text-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-slate-700 hover:bg-gray-50 mb-3">
                        Edit Course Details
                    </a>
                </div>
            </div>

        </div>
    </div>
</body>

</html>