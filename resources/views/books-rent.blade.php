@extends('layouts.main')

@section('title', 'Rent a Book')

@section('content')

    <div class="bg-white rounded-xl mt-8 shadow-lg overflow-hidden mx-auto max-w-screen-md">
        <div class="flex justify-between items-center p-4 bg-gray-50 border-b">
            <h3 class="text-xl font-semibold">Rent a Book</h3>
        </div>

        <form method="POST" action="" class="p-6">
            @csrf
            <div class="space-y-6">

                <!-- User Selection -->
                <div>
                    <label for="user" class="block text-sm font-medium text-gray-700">Select User</label>
                    <div class="mt-1">
                        <select id="user" name="user_id" class="block w-full mt-1 select2">
                            <option value="">Choose a user</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('user')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Book Selection -->
                <div>
                    <label for="book" class="block text-sm font-medium text-gray-700">Select Book</label>
                    <div class="mt-1">
                        <select id="book" name="book_id" class="block w-full mt-1 select2">
                            <option value="">Choose a book</option>
                            @foreach($books as $book)
                                <option value="{{ $book->id }}">{{ $book->book_code }} - {{ $book->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('book')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
                        Rent Book
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

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

    @if(session('error'))
        <script>
            Swal.fire({
                title: "Oops...",
                text: "{{ session('error') }}",
                icon: "error",
                confirmButtonColor: '#4F46E5'
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: true,

            });
        });

    </script>
@endsection
