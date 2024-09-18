<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function home()
    {
        $books = Book::all();
        return view('home', ['books' => $books]);

    }

    public function add()
    {
        $categories = Category::all();
        return view('book-add', ['categories' => $categories]);
    }

    public function addBook(Request $request)
    {
        $request->validate([
            'book_code' => ['required', 'max:255', 'min:1', 'unique:books'],
            'title' => ['required', 'max:255', 'min:1'],
            'cover' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            'status' => ['nullable', 'in:in stock,out of stock'],
        ]);

        $coverPath = 'public/images/default-cover.jpg';

        if ($request->hasFile('cover')) {
            $extension = $request->file('cover')->getClientOriginalExtension();
            $newFilename = $request->title . '-' . now()->timestamp . '.' . $extension;
            $request->file('cover')->storeAs('public/images', $newFilename);
            $coverPath = $newFilename;
        }

        $book = Book::create([
            'book_code' => $request->book_code,
            'title' => $request->title,
            'cover' => $coverPath,
            'status' => $request->status,
        ]);

        $book->categories()->sync($request->categories);

        return redirect('/home')->with('success', 'Book added successfully!');
    }

    public function editBook($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $categories = Category::all();
        $selectedCategories = $book->categories->pluck('id')->toArray();

        return view('book-edit', ['book' => $book, 'categories' => $categories, 'selectedCategories' => $selectedCategories]);
    }

    public function updateBook(Request $request, $slug)
    {
        $book = Book::where('slug', $slug)->first();

        $request->validate([
            'book_code' => ['required', 'max:255', 'min:1', 'unique:books,book_code,' . $book->id],
            'title' => ['required', 'max:255', 'min:1'],
            'cover' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            'status' => ['nullable', 'in:in stock,out of stock'],
        ]);

        if (!$request->cover) {
            if ($book->cover != 'public/images/default-cover.jpg') {
                $extension = pathinfo($book->cover, PATHINFO_EXTENSION);
                $newFilename = Str::slug($request->title) . '-' . now()->timestamp . '.' . $extension;
                Storage::move('public/images/' . $book->cover, 'public/images/' . $newFilename);
                $coverPath = $newFilename;
            } else {
                $coverPath = $book->cover;
            }

        } else {
            $extension = $request->file('cover')->getClientOriginalExtension();
            $newFilename = $request->title . '-' . now()->timestamp . '.' . $extension;
            $request->file('cover')->storeAs('public/images', $newFilename);
            $coverPath = $newFilename;
        }

        $newSlug = Str::slug($request->title);

        $book->update([
            'book_code' => $request->book_code,
            'title' => $request->title,
            'slug' => $newSlug,
            'cover' => $coverPath,
            'status' => $request->status,
        ]);

        $book->categories()->sync($request->categories);

        return redirect('/home')->with('success', 'Book updated successfully!');
    }

    public function deleteBook($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $book->delete();
        return redirect('/home')->with('success', 'Book deleted successfully!');
    }

    public function deletedBook()
    {
        $books = Book::onlyTrashed()->with('categories')->get();
        return view('book-deleted', ['books' => $books]);
    }

    public function restoreBook($slug)
    {
        $book = Book::onlyTrashed()->where('slug', $slug)->first();
        $book->restore();
        return redirect('/home')->with('success', 'Book restored successfully!');
    }


}
