<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $participant->full_name }} - Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-gray-100 font-sans text-slate-800">

    <x-navbar />

    <div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Student Profile</h1>
                <p class="mt-1 text-slate-500">Detailed records for this student.</p>
            </div>
            <a href="/participants" class="text-slate-600 hover:text-slate-900 font-medium">
                <i class="fas fa-arrow-left mr-1"></i> Back to List
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="md:col-span-1">
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="bg-slate-800 p-6 text-center">
                        <div class="h-24 w-24 mx-auto rounded-xl bg-teal-500 flex items-center justify-center text-3xl font-bold text-white mb-4">
                            {{ substr($participant->full_name, 0, 1) }}
                        </div>
                        <h2 class="text-xl font-bold text-white">{{ $participant->full_name }}</h2>
                        <p class="text-teal-200 text-sm">ID: #{{ $participant->participant_id }}</p>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase">Email</label>
                            <p class="text-slate-700 font-medium">{{ $participant->email }}</p>
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
                            <a href="{{ route('participants.edit', $participant->participant_id) }}" class="block w-full text-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-slate-700 hover:bg-gray-50">
                                Edit Profile
                            </a>
                        </div>
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
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registration Date</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($participant->courses as $course)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('courses.show', $course->course_id) }}" class="text-sm font-bold text-teal-600 hover:underline">
                                            {{ $course->course_name }}
                                        </a>
                                        <div class="text-xs text-gray-500">{{ $course->instructor_name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $course->pivot->registration_date }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <form action="{{ route('courses.discharge', ['course' => $course->course_id, 'participant' => $participant->participant_id]) }}" method="POST" onsubmit="return confirm('Drop this class?');" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-rose-500 hover:text-rose-700 text-xs font-bold uppercase">
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
                            <a href="/courses" class="mt-2 inline-block text-teal-600 hover:text-teal-800 font-medium">Go to Course Catalog &rarr;</a>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</body>
</html>