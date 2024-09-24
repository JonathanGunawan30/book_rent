@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <main class="flex-1 p-6">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold mb-8 text-gray-800">Welcome, admin</h2>

            <!-- Cards Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Books Card -->
                <div class="bg-teal-600 text-white p-8 rounded-lg shadow-lg flex items-center justify-between transform hover:scale-105 transition-transform duration-300 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>
                    <div class="text-right">
                        <h3 class="text-2xl font-semibold mb-2">Books</h3>
                        <p class="text-xl">{{$bookCount}}</p>
                    </div>
                </div>
                <!-- Categories Card -->
                <div class="bg-orange-600 text-white p-8 rounded-lg shadow-lg flex items-center justify-between transform hover:scale-105 transition-transform duration-300 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                    </svg>
                    <div class="text-right">
                        <h3 class="text-2xl font-semibold mb-2">Categories</h3>
                        <p class="text-xl">{{$categoryCount}}</p>
                    </div>
                </div>
                <!-- Users Card -->
                <div class="bg-purple-700 text-white p-8 rounded-lg shadow-lg flex items-center justify-between transform hover:scale-105 transition-transform duration-300 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <div class="text-right">
                        <h3 class="text-2xl font-semibold mb-2">Users</h3>
                        <p class="text-xl">{{$userCount}}</p>
                    </div>
                </div>
            </div>


        </div>
    </main>
@endsection
