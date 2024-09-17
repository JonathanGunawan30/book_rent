@extends('layouts.main')

@section('title', 'Deleted Category')

@section('content')

    <div class="bg-white rounded-xl mt-8 shadow-lg overflow-hidden mx-auto max-w-screen-xl">
        <div class="flex justify-between items-center p-4 bg-gray-50 border-b">
            <h3 class="text-xl font-semibold">Deleted Category</h3>
            <div>
                <a href="/categories" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600">
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="w-40 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($categories as $index => $category)
                        <tr>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 text-center">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $category->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 space-x-2">
                                <!-- Tombol Restore -->
                                <a href="javascript:void(0);" data-id="{{ $category->slug }}" class="restore-btn inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600">
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
                const categorySlug = this.getAttribute('data-id');

                // Menggunakan SweetAlert untuk konfirmasi restore
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This category will be restored!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2563eb', // Hijau untuk restore
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, restore it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Arahkan ke route restore dengan slug kategori
                        window.location.href = `/category/restore/${categorySlug}`;
                    }
                })
            });
        });
    </script>
@endsection
