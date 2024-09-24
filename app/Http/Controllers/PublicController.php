<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublicController extends Controller
{
    public function index(Request $request)
    {

        $books = Book::all();
        $categories = Category::all();

        if ($request->ajax()) {
            return view('books-grid', compact('books', ))->render();
        }
        return view('book-list', compact('books', 'categories'));
    }


    public function search(Request $request, $uuid)
    {

        $query = $request->input('query');
        $books = Book::where('title', 'LIKE', "%{$query}%")
            ->orWhere('book_code', 'LIKE', "%{$query}%")
            ->get();

        if ($books->isEmpty()) {
            return response()->json(['html' => '<p class="text-gray-500 text-center">No books found.</p>']);
        }

        $html = view('books-grid', compact('books'))->render();
        return response()->json(['html' => $html]);
    }


}
