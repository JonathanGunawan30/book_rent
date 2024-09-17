<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categories()
    {
        $categories = Category::all();
        return view('category', ['categories' => $categories]);
    }

    public function add()
    {
        return view('category-add');
    }

    public function addProcess(Request $request)
    {
        $request->validate([
           'name' => ['required', 'string', 'max:100', 'min:1','unique:categories'],
        ]);
        Category::create($request->all());
        return redirect('/categories')->with('success', 'Category added successfully!');
    }

    public function edit ($slug)
    {
        $category = Category::where('slug', $slug)->first();
        return view('category-edit', ['category' => $category]);
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100', 'min:1', 'unique:categories'],
        ]);

        $category = Category::where('slug', $slug)->first();
        $category->slug= null;
        $category->update(request()->all());

        return redirect('/categories')->with('success', 'Category updated successfully!');
    }

    public function delete ($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $category->delete();
        return redirect('/categories')->with('success', 'Category deleted successfully!');
    }

    public function deleted()
    {
        $categories = Category::onlyTrashed()->get();
        return view('category-deleted', ['categories' => $categories]);
    }

    public function restore ($slug)
    {
        $category = Category::onlyTrashed()->where('slug', $slug)->first();
        $category->restore();
        return redirect('/categories')->with('success', 'Category restored successfully!');
    }
}
