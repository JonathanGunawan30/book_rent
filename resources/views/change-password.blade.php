@extends('layouts.main')

@section('title', 'Update Password')

@section('content')

    <div class="max-w-screen-xl mx-auto px-4 py-8">
        <div class="max-w-md mx-auto overflow-hidden md:max-w-2xl">
            <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
                <div class="p-8">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800">Update Password</h2>
                    <form action="/profile/change_password" method="POST">
                        @csrf

                        <!-- New Password -->
                        <div class="mb-6">
                            <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                            <input type="password" name="new_password" id="new_password"
                                   class="shadow-sm focus:ring-indigo-500 focus:border-transparent block w-full sm:text-sm border-gray-300 rounded-md py-4 px-4"
                                   placeholder="Enter new password" required>
                            @error('new_password')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-6">
                            <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password"
                                   class="shadow-sm focus:ring-indigo-500 focus:border-transparent block w-full sm:text-sm border-gray-300 rounded-md py-4 px-4"
                                   placeholder="Confirm new password" required>
                            @error('confirm_password')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Update Password
                            </button>
                            <a href="/profile" class="text-sm text-indigo-600 hover:text-indigo-500 hover:underline">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
