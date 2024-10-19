<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Ticket</title>
    @vite('resources/css/app.css')
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

    <!-- Form Create Ticket -->
    <div class="max-w-4xl mx-auto my-10 p-8 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold text-center mb-8">Create Ticket</h1>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('ticket.store') }}" method="POST" class="grid grid-cols-6 gap-6">
            @csrf

            <div class="col-span-6">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" required
                    class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm">
            </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="office_id" class="block text-sm font-medium text-gray-700">Office</label>
                <select id="office_id" name="office_id" required
                    class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm">
                    <option value="">Select Office</option>
                    @foreach ($offices as $office)
                        <option value="{{ $office->id }}">{{ $office->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="location_id" class="block text-sm font-medium text-gray-700">Location</label>
                <select id="location_id" name="location_id" required
                    class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm">
                    <option value="">Select Location</option>
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                <select id="category_id" name="category_id" required
                    class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="subcategory_id" class="block text-sm font-medium text-gray-700">Subcategory</label>
                <select id="subcategory_id" name="subcategory_id" required
                    class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm">
                    <option value="">Select Subcategory</option>
                    @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-span-6">
                <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
                <input type="date" id="deadline" name="deadline"
                    class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm">
            </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                <textarea id="subject" name="subject"
                    class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm"></textarea>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description"
                    class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm"></textarea>
            </div>

            <div class="col-span-6 sm:flex sm:items-center sm:gap-4 flex justify-end">
                <button type="submit"
                    class="inline-block shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500">
                    Submit
                </button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
