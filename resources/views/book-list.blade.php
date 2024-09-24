@extends('layouts.main')

@section('title', 'Books')

<style>
    @import url("https://fonts.googleapis.com/css2?family=Russo+One&display=swap");

    .welcome-text-wrapper {
        display: flex;
        justify-content: center;
        margin: 4em 0;
    }

    svg {
        font-family: "Russo One", sans-serif;
        width: 100%;
        height: auto;
        overflow: visible;
    }

    svg text {
        animation: stroke 3s infinite alternate;
        stroke-width: 2;
        stroke: #4338ca;
        font-size: clamp(3rem, 10vw, 12em);
    }

    @keyframes stroke {
        0% {
            fill: rgba(124, 58, 237, 0); /* transparan */
            stroke: #4f46e5; /* indigo 600 */
            stroke-dashoffset: 25%;
            stroke-dasharray: 0 50%;
            stroke-width: 2;
        }
        70% {
            fill: rgba(124, 58, 237, 0); /* transparan */
            stroke: #4f46e5; /* indigo 600 */
        }
        80% {
            fill: rgba(124, 58, 237, 0); /* transparan */
            stroke: #4f46e5; /* indigo 600 */
            stroke-width: 3;
        }
        100% {
            fill: #4f46e5; /* indigo 600 */
            stroke: rgba(124, 58, 237, 0); /* transparan */
            stroke-dashoffset: -25%;
            stroke-dasharray: 50% 0;
            stroke-width: 0;
        }
    }



    .wrapper {
        padding-left: 2rem;
        padding-right: 2rem;
    }
</style>

@section('content')
    <div class="welcome-text-wrapper">
        <div class="wrapper">
            <svg viewBox="0 0 1200 100" preserveAspectRatio="xMidYMid meet" style="overflow: visible">
                <text x="50%" y="50%" dy=".35em" text-anchor="middle">
                    Selamat Datang Di Rental Buku
                </text>
            </svg>
        </div>
    </div>

    {{-- Search Form --}}
    <div class="container mx-auto mb-6">
        <div class="flex items-center justify-center">
            <input
                type="text"
                id="search"
                name="search"
                placeholder="Search books by title or book code..."
                class="w-full max-w-md px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-indigo-500 outline-none"
            />
        </div>
    </div>




    {{-- Books Grid --}}
    <div id="books-container" class="container mx-auto mt-6">

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($books as $book)
                    <div class="book-item bg-white shadow-lg rounded-lg overflow-hidden transform hover:scale-105 transition duration-300 ease-in-out hover:shadow-2xl">
                        @if($book->cover == 'public/images/default-cover.jpg')
                            <img src="images/default-cover.png" alt="Book Title"
                                 class="w-full h-48 object-cover transition duration-300 ease-in-out">
                        @else
                            <img src="storage/public/images/{{$book->cover}}" alt="Book Title"
                                 class="w-full h-48 object-cover transition duration-300 ease-in-out">
                        @endif

                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 hover:text-indigo-500 transition duration-300 ease-in-out">{{$book->title}}</h3>
                            <p class="text-gray-600 mt-1 font-medium">Book Code: {{$book->book_code}}</p>

                            <div class="mt-4 flex items-center justify-between">
                    <span class="text-sm font-medium {{$book->status == 'in stock' ? 'text-green-500' : 'text-red-500' }}">
                        {{$book->status}}
                    </span>

                                @if($book->status == 'in stock')
                                    <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-600 transform hover:scale-110 transition duration-300 ease-in-out">
                                        Borrow
                                    </button>
                                @else
                                    <button class="bg-indigo-500 text-white px-4 py-2 rounded opacity-50 cursor-not-allowed focus:outline-none focus:ring focus:ring-indigo-300" disabled>
                                        Borrow
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    </div>

@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let uuid = crypto.randomUUID();

        $('#search').on('input', function() {
            var query = $(this).val();
            if(query.length >= 2) {
                $.ajax({
                    url: '/books/search/' + uuid ,
                    method: 'GET',
                    data: { query: query },
                    success: function(response) {
                        $('#books-container').html(response.html);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            } else if(query.length === 0) {

                $.ajax({
                    url: '{{ route("books.index") }}',
                    method: 'GET',
                    success: function(data) {
                        $('#books-container').html(data);
                    }
                });
            }
        });
    </script>
@endsection
