<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skill Hub - Courses</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-gray-100 font-sans text-slate-800">

    <nav class="bg-slate-900 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 font-bold text-xl tracking-wide text-teal-400">
                        <i class="fas fa-cubes mr-2"></i> SKILL HUB
                    </div>
                    <div class="hidden md:flex ml-10 space-x-8">
                        <a href="/participants" class="border-b-2 border-transparent text-gray-400 hover:text-gray-200 hover:border-gray-500 px-1 py-4 text-sm font-medium transition">
                            Participants
                        </a>
                        <a href="/courses" class="border-b-2 border-teal-400 text-white px-1 py-4 text-sm font-medium">
                            Courses
                        </a>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="h-8 w-8 rounded bg-teal-500 flex items-center justify-center text-xs font-bold text-white">
                        AD
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        
        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Course Catalog</h1>
                <p class="mt-1 text-sm text-slate-500">Manage classes and instructor assignments.</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="#" class="inline-flex items-center justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition">
                    <i class="fas fa-plus mr-2"></i> Add New Course
                </a>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-slate-800">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">Course Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">Instructor</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">Schedule</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">Students</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($courses as $course)
                    <tr class="hover:bg-slate-50 transition duration-150 ease-in-out">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-lg bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold border border-indigo-200">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-bold text-slate-900">{{ $course->course_name }}</div>
                                    <div class="text-xs text-slate-500 truncate w-48" title="{{ $course->course_description }}">
                                        {{ Str::limit($course->course_description, 40) }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-slate-700 font-medium">
                                <i class="fas fa-chalkboard-teacher mr-2 text-teal-500"></i> {{ $course->instructor_name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-xs text-slate-500">
                                <div><span class="font-bold text-slate-700">Start:</span> {{ $course->start_date ? \Carbon\Carbon::parse($course->start_date)->format('M d, Y') : 'TBA' }}</div>
                                <div><span class="font-bold text-slate-700">End:</span> {{ $course->end_date ? \Carbon\Carbon::parse($course->end_date)->format('M d, Y') : 'TBA' }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2.5 py-0.5 rounded-md text-xs font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                <i class="fas fa-users mr-1"></i> {{ $course->participants_count }} Enrolled
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900 inline-block mr-3" title="Edit">
                                <i class="fas fa-edit text-lg"></i>
                            </a>
                            <a href="#" class="text-rose-500 hover:text-rose-700 inline-block" title="Delete">
                                <i class="fas fa-trash-alt text-lg"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>