<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $bookCount = Book::count();
        $categoryCount = Category::count();
        $userCount = User::where('role_id', 2)->where('status', 'active')->count();
        return view('dashboard', ['bookCount' => $bookCount, 'categoryCount' => $categoryCount, 'userCount' => $userCount]);
    }
}
