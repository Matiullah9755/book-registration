<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Book Registration System
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- د بریالیتوب پیغام --}}
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- د تېروتنې پیغامونه --}}
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- د کتاب ثبتولو فورمه --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-bold mb-4">Register a New Book</h3>

                <form action="{{ route('books.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="title" class="block mb-1 font-medium">
                            Book Title
                        </label>

                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm"
                            required
                            maxlength="150"
                        >
                    </div>

                    <div class="mb-4">
                        <label for="author" class="block mb-1 font-medium">
                            Author Name
                        </label>

                        <input
                            type="text"
                            id="author"
                            name="author"
                            value="{{ old('author') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm"
                            required
                            maxlength="100"
                        >
                    </div>

                    <div class="mb-4">
                        <label for="pages" class="block mb-1 font-medium">
                            Number of Pages
                        </label>

                        <input
                            type="number"
                            id="pages"
                            name="pages"
                            value="{{ old('pages') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm"
                            min="1"
                            max="10000"
                            required
                        >
                    </div>

                    <button
                        type="submit"
                        class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                    >
                        Register Book
                    </button>
                </form>
            </div>

            {{-- د کتابونو جدول --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">My Registered Books</h3>

                @if ($books->isEmpty())
                    <p class="text-gray-600">
                        No books registered yet.
                    </p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border p-3 text-left">#</th>
                                    <th class="border p-3 text-left">Title</th>
                                    <th class="border p-3 text-left">Author</th>
                                    <th class="border p-3 text-left">Pages</th>
                                    <th class="border p-3 text-left">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($books as $book)
                                    <tr>
                                        <td class="border p-3">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="border p-3">
                                            {{ $book->title }}
                                        </td>

                                        <td class="border p-3">
                                            {{ $book->author }}
                                        </td>

                                        <td class="border p-3">
                                            {{ $book->pages }}
                                        </td>

                                        <td class="border p-3">
                                            <form
                                                action="{{ route('books.destroy', $book->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this book?');"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="px-3 py-2 bg-red-600 text-white rounded hover:bg-red-700"
                                                >
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>

