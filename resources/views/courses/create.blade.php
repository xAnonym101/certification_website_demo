<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Course</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body class="bg-gray-100 font-sans text-slate-800">

    <div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Create New Course</h1>
                <p class="mt-1 text-sm text-slate-500">Add a new class to the curriculum.</p>
            </div>
            <a href="/courses" class="text-slate-600 hover:text-slate-900 text-sm font-medium">
                <i class="fas fa-arrow-left mr-1"></i> Back to Catalog
            </a>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
            <form action="{{ route('courses.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <div>
                    <label for="course_name" class="block text-sm font-medium text-slate-700">Course Name</label>
                    <input type="text" name="course_name" id="course_name" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm border p-2"
                        placeholder="e.g. Advanced Laravel Development">
                </div>

                <div>
                    <label for="instructor_name" class="block text-sm font-medium text-slate-700">Instructor
                        Name</label>
                    <input type="text" name="instructor_name" id="instructor_name" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm border p-2"
                        placeholder="e.g. Dr. Taylor Otwell">
                </div>

                <div>
                    <label for="course_description" class="block text-sm font-medium text-slate-700">Description</label>
                    <textarea name="course_description" id="course_description" rows="4" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm border p-2"
                        placeholder="What will students learn?"></textarea>
                </div>

                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-slate-700">Start Date</label>
                        <input type="date" name="start_date" id="start_date"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm border p-2">
                    </div>

                    <div>
                        <label for="end_date" class="block text-sm font-medium text-slate-700">End Date</label>
                        <input type="date" name="end_date" id="end_date"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm border p-2">
                    </div>
                </div>

                <div class="flex justify-end pt-4 border-t border-gray-100">
                    <a href="/courses"
                        class="mr-3 bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-slate-700 hover:bg-gray-50 focus:outline-none">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                        Create Course
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>