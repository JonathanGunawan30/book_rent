<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rental Buku | @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>
<body class="bg-gray-100">

<!-- Navbar -->
<nav class="bg-indigo-700 text-white p-4">
    <div class="container mx-auto">
        <h1 class="text-lg font-semibold">Rental Buku</h1>
    </div>
</nav>

<!-- Main Content Wrapper -->
<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-gray-200 flex-shrink-0">
        <div class="p-4">
            <ul class="space-y-4">
                @if(\Illuminate\Support\Facades\Auth::user())
                    @if(\Illuminate\Support\Facades\Auth::user()->role_id == 1)
                        <li>
                            <a href="/dashboard"
                               class="block text-lg font-semibold p-2 rounded {{ request()->is('dashboard') ? 'bg-indigo-500 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="/home"
                               class="block text-lg font-semibold p-2 rounded {{ request()->is('home') || request()->is('book/*') || request()->is('home/*')   ?  'bg-indigo-500 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
                                Books
                            </a>
                        </li>
                        <li>
                            <a href="/categories"
                               class="block text-lg font-semibold p-2 rounded {{ request()->is('categories') ||  request()->is('category/*') ? 'bg-indigo-500 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
                                Categories
                            </a>
                        </li>
                        <li>
                            <a href="/users"
                               class="block text-lg font-semibold p-2 rounded {{ request()->is('users') || request()->is('users/*') ? 'bg-indigo-500 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
                                Users
                            </a>
                        </li>
                        <li>
                            <a href="/rent-logs"
                               class="block text-lg font-semibold p-2 rounded {{ request()->is('rent-logs') ? 'bg-indigo-500 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
                                Rent Log
                            </a>
                        </li>
                        <li>
                            <a href="/"
                               class="block text-lg font-semibold p-2 rounded {{ request()->is('/') ? 'bg-indigo-500 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
                                Book List
                            </a>
                        </li>
                        <li>
                            <a href="/books/rent"
                               class="block text-lg font-semibold p-2 rounded {{ request()->is('books/*') ? 'bg-indigo-500 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
                                Book Rent
                            </a>
                        </li>
                        <li>
                            <a href="/logout"
                               class="block text-lg font-semibold p-2 rounded {{ request()->is('logout') ? 'bg-indigo-500 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
                                Logout
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="/profile"
                               class="block text-lg font-semibold p-2 rounded {{ request()->is('profile') ? 'bg-indigo-500 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
                                Profile
                            </a>
                        </li>
                        <li>
                            <a href="/"
                               class="block text-lg font-semibold p-2 rounded {{ request()->is('/') ? 'bg-indigo-500 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
                                Book List
                            </a>
                        </li>
                        <li>
                            <a href="/logout"
                               class="block text-lg font-semibold p-2 rounded {{ request()->is('logout') ? 'bg-indigo-500 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
                                Logout
                            </a>
                        </li>
                    @endif
                @else
                    <a href="/login"
                       class="block text-lg font-semibold p-2 rounded {{ request()->is('logout') ? 'bg-indigo-500 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
                        Login
                    </a>
                @endif
            </ul>
        </div>
    </aside>

    <!-- Content Area -->
    <main class="flex-1 p-6 bg-white">
        <div class="container mx-auto">
            @yield('content')
        </div>
    </main>

    @yield('scripts')

</div>

</body>
</html>
