<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rental Buku | Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">

<section class="bg-white dark:bg-gray-900">

    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        @if(session('message'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium">{{ session('message') }}</span>
            </div>
        @endif
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Register a new account
                </h1>
                <form class="space-y-4 md:space-y-6" action="" method="post">
                    @csrf
                    <div>
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                        <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500" placeholder="John Doe" value="{{ old('username') }}">
                        @error('username')
                        <div class="p-2 text-sm text-red-600 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                        @error('password')
                        <div class="p-2 text-sm text-red-600 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone (optional)</label>
                        <input type="text" name="phone" id="phone" placeholder="08xx-xxxx-xxxx" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500" value="{{ old('phone') }}">
                        @error('phone')
                        <div class="p-2 text-sm text-red-600 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                        <textarea name="address" id="address" placeholder="Your full address" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500" rows="3">{{ old('address') }}</textarea>
                        @error('address')
                        <div class="p-2 text-sm text-red-600 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="w-full text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Register</button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Already have an account? <a href="login" class="font-medium text-indigo-600 hover:underline dark:text-indigo-500">Sign in</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

</body>
</html>
