@extends('layouts.main')

@section('title', 'Update Profile')

@section('content')

    <div class="max-w-screen-xl mx-auto px-4 py-8">
        <div class="max-w-md mx-auto overflow-hidden md:max-w-2xl">
        </div>
        <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
            <div class="p-8">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Update Profile</h2>
                <form action="/profile/edit" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Username -->
                    <div class="mb-6">
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                        <input type="text" name="username" id="username"
                               class="shadow-sm focus:ring-indigo-500 focus:border-transparent block w-full sm:text-sm border-gray-300 rounded-md py-4 px-4"
                               placeholder="Enter your username" value="{{ old('username', $user->username) }}" required autofocus>
                        @error('username')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="mb-6">
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                        <input type="text" name="phone" id="phone"
                               class="shadow-sm focus:ring-indigo-500 focus:border-transparent block w-full sm:text-sm border-gray-300 rounded-md py-4 px-4"
                               placeholder="Enter your phone number" value="{{ old('phone', $user->phone) }}" required>
                        @error('phone')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="mb-6">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                        <textarea name="address" id="address" rows="4"
                                  class="shadow-sm focus:ring-indigo-500 focus:border-transparent block w-full sm:text-sm border-gray-300 rounded-md py-4 px-4"
                                  placeholder="Enter your address" required>{{ old('address', $user->address) }}</textarea>
                        @error('address')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update Profile
                        </button>
                        <a href="/profile" class="text-sm text-indigo-600 hover:text-indigo-500 hover:underline">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
