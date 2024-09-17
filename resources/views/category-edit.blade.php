@extends('layouts.main')

@section('title', 'Edit Category')

@section('content')

    <div class="max-w-screen-xl mx-auto px-4 py-8">
        <div class="max-w-md mx-auto overflow-hidden md:max-w-2xl">
            @if($errors->any())
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li class="font-medium">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


        </div>
        <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
            <div class="p-8">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Category</h2>
                <form action="/category/edit/{{$category->slug}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Category Name</label>
                        <input type="text" name="name" id="name"
                               class="shadow-sm focus:ring-indigo-500 focus:border-transparent block w-full sm:text-sm border-gray-300 rounded-md py-4 px-4"
                               placeholder="Enter category name" value="{{$category->name}}" required>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update Category
                        </button>
                        <a href="/categories" class="text-sm text-indigo-600 hover:text-indigo-500 hover:underline">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection



