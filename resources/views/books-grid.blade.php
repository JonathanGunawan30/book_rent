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

                </div>
            </div>
        </div>
    @endforeach
</div>
