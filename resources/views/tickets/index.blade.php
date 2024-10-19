<!-- resources/views/tickets/index.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <header class="bg-white">
        <div class="mx-auto flex h-16 max-w-screen-xl items-center justify-end gap-8 px-4 sm:px-6 lg:px-8">
            <a class="block text-teal-600 sr-only" href="#">
                Angkasa Cipta
            </a>

            <a class="group relative inline-flex items-center overflow-hidden rounded bg-indigo-600 px-8 py-3 text-white focus:outline-none focus:ring active:bg-indigo-500"
                href="/admin/login">
                <span class="absolute -start-full transition-all group-hover:start-4">
                    <svg class="size-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </span>

                <span class="text-sm font-medium transition-all group-hover:ms-4"> Login </span>
            </a>
        </div>
    </header>

    <div class="max-w-screen-xl mx-auto mt-10 p-8 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold text-center mb-8">Ticket List</h1>

        <a href="{{ route('welcome') }}"
            class="group relative inline-block text-sm font-medium text-indigo-600 focus:outline-none focus:ring active:text-indigo-500">
            <span
                class="absolute inset-0 translate-x-0.5 translate-y-0.5 bg-indigo-600 transition-transform group-hover:translate-x-0 group-hover:translate-y-0"></span>
            <span class="relative block border border-current bg-white px-8 py-3"> Create New Ticket </span>
        </a>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md my-6">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm my-6">
            <thead class="ltr:text-left rtl:text-right">
                <tr>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Name</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Office</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Location</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Category</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Subcategory</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Deadline</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($tickets as $ticket)
                    <tr>
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-700">{{ $ticket->name }}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $ticket->office->name }}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $ticket->location->name }}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $ticket->category->name }}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $ticket->subcategory->name }}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $ticket->deadline }}</td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="whitespace-nowrap px-4 py-2 text-gray-700 text-center">No tickets
                            found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>

</html>
