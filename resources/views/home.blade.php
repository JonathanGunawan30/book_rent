@extends('layouts.main')

@section('title', 'Books')

@section('content')
    <style>
        .hidden {
            display: none;
        }
    </style>

    <div class="bg-white rounded-xl mt-8 shadow-lg overflow-hidden mx-auto max-w-screen-xl">
        <div class="flex justify-between items-center p-4 bg-gray-50 border-b">
            <h3 class="text-xl font-semibold">Book List</h3>
            <div class="space-x-2">
                <a href="/book/deleted"
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-sky-500 hover:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                    View Deleted Book
                </a>
                <a href="/book/add"
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600">
                    Add Book
                </a>
            </div>
        </div>

        <div class="overflow-x-auto mt-4">
            <div class="w-full">
                <table class="w-full min-w-max">
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="w-16 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            No.
                        </th>
                        <th class="w-28 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Code
                        </th>
                        <th class="w-96 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Title
                        </th>
                        <th class="w-64 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Categories
                        </th>
                        <th class="w-24 px-8 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="w-52 px-20 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                    @foreach($books as $index => $book)
                        <tr>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 text-center">{{$index + 1}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{$book->book_code}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$book->title}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex flex-col gap-1">
                                    <div class="flex flex-wrap categories-preview">
                                        @foreach($book->categories->take(5) as $category)
                                            <span class="bg-gray-200 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded mr-2 mb-1">
                                                {{ $category->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                    <div class="categories-more hidden">
                                        @foreach($book->categories->chunk(5) as $chunk)
                                            <div class="category-group flex flex-wrap">
                                                @foreach($chunk as $category)
                                                    <span class="bg-gray-200 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded mr-2 mb-1">
                                                        {{ $category->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                    @if($book->categories->count() > 5)
                                        <a href="javascript:void(0);" class="text-indigo-600 hover:underline more-link">
                                            +{{ $book->categories->count() - 5 }} more
                                        </a>
                                    @endif
                                </div>
                            </td>
                            <td class="px-8 py-4 whitespace-nowrap text-sm font-medium text-left w-32 {{$book->status == 'in stock' ? 'text-green-500' : 'text-red-500'}}">
                                {{$book->status}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right space-x-2">
                                <a href="/book/edit/{{$book->slug}}"
                                   class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Edit
                                </a>
                                <a href="javascript:void(0);" data-id="{{$book->slug}}"
                                   class="delete-btn inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    @if(session('success'))
        <script>
            Swal.fire({
                title: "Success!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonColor: '#4F46E5'
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Event listener for "more" and "less" links
            document.querySelectorAll('.more-link').forEach(link => {
                link.addEventListener('click', function () {
                    const parentRow = this.closest('tr');
                    const previewCategories = parentRow.querySelector('.categories-preview');
                    const moreCategories = parentRow.querySelector('.categories-more');

                    const isHidden = moreCategories.classList.contains('hidden');

                    if (isHidden) {
                        // Show more categories
                        previewCategories.classList.add('hidden');
                        moreCategories.classList.remove('hidden');
                        this.textContent = 'Less'; // Update text for "less"
                    } else {
                        // Show fewer categories
                        previewCategories.classList.remove('hidden');
                        moreCategories.classList.add('hidden');
                        const totalCategories = parentRow.querySelectorAll('.categories-more .category-group span').length;
                        this.textContent = `+${totalCategories - 5} more`; // Update text dynamically
                    }
                });
            });
        });

        // Event listener for delete button
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const bookSlug = this.getAttribute('data-id'); // Adjust if needed

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#1d4ed8',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = `/book/delete/${bookSlug}`; // Adjust URL as needed
                        }
                    });
                });
            });
        });
    </script>

@endsection
