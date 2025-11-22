<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skill Hub Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body class="bg-gray-100 font-sans text-slate-800">

    <x-navbar />

    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Student Directory</h1>
                <p class="mt-1 text-sm text-slate-500">View and manage your student database.</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('participants.create') }}"
                    class="inline-flex items-center justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition">
                    <i class="fas fa-user-plus mr-2"></i> Add Participant
                </a>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-slate-800">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">ID</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">Student
                            Profile</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">Contact
                            Info</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">Status
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-bold text-gray-300 uppercase tracking-wider">Manage
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($participants as $participant)
                        <tr class="hover:bg-slate-50 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 font-mono">
                                #{{ str_pad($participant->participant_id, 3, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 h-10 w-10 rounded-lg bg-slate-100 flex items-center justify-center text-slate-600 font-bold border border-slate-200">
                                        {{ substr($participant->full_name, 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-slate-900">{{ $participant->full_name }}</div>
                                        <div class="text-xs text-slate-500">Reg:
                                            {{ $participant->created_at->format('d M Y') }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-slate-700 flex items-center">
                                    <i class="far fa-envelope w-5 text-teal-500"></i> {{ $participant->email }}
                                </div>
                                <div class="text-sm text-slate-500 flex items-center mt-1">
                                    <i class="fas fa-mobile-alt w-5 text-teal-500"></i> {{ $participant->phone_number }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($participant->courses->count() > 0)
                                    <span
                                        class="px-2.5 py-0.5 rounded-md text-xs font-medium bg-teal-100 text-teal-800 border border-teal-200">
                                        Active ({{ $participant->courses->count() }})
                                    </span>
                                @else
                                    <span
                                        class="px-2.5 py-0.5 rounded-md text-xs font-medium bg-gray-100 text-gray-600 border border-gray-200">
                                        Unregistered
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('participants.edit', $participant->participant_id) }}"
                                    class="text-indigo-600 hover:text-indigo-900 inline-block mr-3" title="Edit">
                                    <i class="fas fa-edit text-lg"></i>
                                </a>
                                <form action="{{ route('participants.destroy', $participant->participant_id) }}"
                                    method="POST" class="inline-block"
                                    onsubmit="return confirm('Are you sure you want to delete this student?');">
                                    @csrf
                                    @method('DELETE') <button type="submit"
                                        class="text-rose-500 hover:text-rose-700 border-none bg-transparent cursor-pointer"
                                        title="Delete">
                                        <i class="fas fa-trash-alt text-lg"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-center">
            <span class="text-xs text-gray-400 uppercase tracking-widest">End of List</span>
        </div>
    </div>

</body>

</html>