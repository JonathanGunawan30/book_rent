<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rental Buku | @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                @if(\Illuminate\Support\Facades\Auth::user()->role_id == 1)
                <li>
                    <a href="dashboard" class="block text-lg font-semibold hover:bg-gray-700 p-2 rounded">Dashboard</a>
                </li>
                <li>
                    <a href="home" class="block text-lg font-semibold hover:bg-gray-700 p-2 rounded">Books</a>
                </li>
                <li>
                    <a href="#" class="block text-lg font-semibold hover:bg-gray-700 p-2 rounded">Categories</a>
                </li>
                <li>
                    <a href="#" class="block text-lg font-semibold hover:bg-gray-700 p-2 rounded">Users</a>
                </li>
                <li>
                    <a href="#" class="block text-lg font-semibold hover:bg-gray-700 p-2 rounded">Rent Log</a>
                </li>
                <li>
                    <a href="logout" class="block text-lg font-semibold hover:bg-gray-700 p-2 rounded">Logout</a>
                </li>
                @else
                    <li>
                        <a href="profile" class="block text-lg font-semibold hover:bg-gray-700 p-2 rounded">Profile</a>
                    </li>
                    <li>
                        <a href="logout" class="block text-lg font-semibold hover:bg-gray-700 p-2 rounded">Logout</a>
                    </li>
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

</div>

</body>
</html>

