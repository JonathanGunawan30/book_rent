@extends('layouts.main')

@section('title', 'Deleted Book')

@section('content')

    <div class="bg-white rounded-xl mt-8 shadow-lg overflow-hidden mx-auto max-w-screen-xl">
        <div class="flex justify-between items-center p-4 bg-gray-50 border-b">
            <h3 class="text-xl font-semibold">Deleted Book</h3>
            <div>
                <a href="/home" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600">
                    Back
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
                        <th class="w-52 px-14 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
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
                            <td class="px-8 py-4 whitespace-nowrap text-sm text-left w-32 {{$book->status == 'in stock' ? 'text-green-500' : 'text-red-500'}}">
                                {{$book->status}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right space-x-2">
                                <!-- Tombol Restore -->
                                <a href="javascript:void(0);" data-id="{{ $book->slug }}" class="restore-btn inline-flex items-center px-6 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600">
                                    Restore
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

    <script>
        // Event listener untuk tombol restore
        document.querySelectorAll('.restore-btn').forEach(button => {
            button.addEventListener('click', function() {
                const bookSlug = this.getAttribute('data-id');

                // Menggunakan SweetAlert untuk konfirmasi restore
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This book will be restored!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2563eb', // Hijau untuk restore
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, restore it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Arahkan ke route restore dengan slug kategori
                        window.location.href = `/book/restore/${bookSlug}`;
                    }
                })
            });
        });
    </script>
@endsection
