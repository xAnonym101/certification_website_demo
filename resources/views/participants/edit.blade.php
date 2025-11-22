<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Participant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body class="bg-gray-100 font-sans text-slate-800">

    <div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Edit Participant</h1>
                <p class="mt-1 text-sm text-slate-500">Update information for <span
                        class="font-bold text-teal-600">{{ $participant->full_name }}</span>.</p>
            </div>
            <a href="{{ route('participants.index') }}" class="text-slate-600 hover:text-slate-900 text-sm font-medium">
                <i class="fas fa-arrow-left mr-1"></i> Back to List
            </a>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">

            <form action="{{ route('participants.update', $participant->participant_id) }}" method="POST"
                class="p-6 space-y-6">
                @csrf
                @method('PUT') <div>
                    <label for="full_name" class="block text-sm font-medium text-slate-700">Full Name</label>
                    <input type="text" name="full_name" id="full_name" required
                        value="{{ old('full_name', $participant->full_name) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm border p-2">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email Address</label>
                    <input type="email" name="email" id="email" required value="{{ old('email', $participant->email) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm border p-2">
                </div>

                <div>
                    <label for="phone_number" class="block text-sm font-medium text-slate-700">Phone Number</label>
                    <input type="text" name="phone_number" id="phone_number" required
                        value="{{ old('phone_number', $participant->phone_number) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm border p-2">
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-slate-700">Address</label>
                    <textarea name="address" id="address" rows="3" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm border p-2">{{ old('address', $participant->address) }}</textarea>
                </div>

                <div class="flex justify-end pt-4 border-t border-gray-100">
                    <a href="{{ route('participants.index') }}"
                        class="mr-3 bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-slate-700 hover:bg-gray-50 focus:outline-none">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                        Update Participant
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>