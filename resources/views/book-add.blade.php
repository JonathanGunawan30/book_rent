@extends('layouts.main')

@section('title', 'Book Add')

@section('content')

    <div class="max-w-screen-xl mx-auto px-4 py-8">
        <div class="max-w-md mx-auto overflow-hidden md:max-w-2xl">
            <!-- Tidak menampilkan pesan error global di sini -->
        </div>
        <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
            <div class="p-8">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Add New Book</h2>
                <form action="/book/add" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-6">
                        <label for="book_code" class="block text-sm font-medium text-gray-700 mb-2">Book Code</label>
                        <input type="text" name="book_code" id="book_code"
                               class="shadow-sm focus:ring-indigo-500 focus:border-transparent block w-full sm:text-sm border-gray-300 rounded-md py-4 px-4"
                               placeholder="Enter Book Code" value="{{ old('book_code') }}" >
                        @error('book_code')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                        <input type="text" name="title" id="title"
                               class="shadow-sm focus:ring-indigo-500 focus:border-transparent block w-full sm:text-sm border-gray-300 rounded-md py-4 px-4"
                               placeholder="Enter Book Title" value="{{ old('title') }}" >
                        @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="cover" class="block text-sm font-medium text-gray-700 mb-2">Cover</label>
                        <input type="file" name="cover" id="cover"
                               class="shadow-sm focus:ring-indigo-500 focus:border-transparent block w-full sm:text-sm border-gray-300 rounded-md py-4 px-4"
                               accept="image/*">
                        @error('cover')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status" id="status"
                                class="shadow-sm focus:ring-indigo-500 focus:border-transparent block w-full sm:text-sm border-gray-300 rounded-md py-4 px-4" required>
                            <option value="in stock" {{ old('status') == 'in stock' ? 'selected' : '' }}>In Stock</option>
                            <option value="out of stock" {{ old('status') == 'out of stock' ? 'selected' : '' }}>Out Of Stock</option>
                        </select>
                        @error('status')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Categories</label>
                        <div class="max-h-60 overflow-y-auto border border-gray-300 rounded-md p-2">
                            @foreach($categories as $category)
                                <div class="flex items-center mb-2">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                           id="category_{{ $category->id }}"
                                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded-md cursor-pointer transition duration-200 ease-in-out transform hover:scale-105 checked:bg-indigo-600 checked:border-indigo-600"
                                        {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
                                    <label for="category_{{ $category->id }}" class="ml-2 text-sm text-gray-600 cursor-pointer">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('categories')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="flex items-center justify-between">
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Add Book
                        </button>
                        <a href="../home" class="text-sm text-indigo-600 hover:text-indigo-500 hover:underline">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
