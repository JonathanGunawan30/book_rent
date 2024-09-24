<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\RentLogs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BookRentController extends Controller
{
    public function index()
    {
        $users = User::where('status', 'active')->where('role_id', 2)->get();
        $books = Book::where('status', 'in stock')->get();
        return view('books-rent', ['users' => $users, 'books' => $books]);
    }

    public function store(Request $request)
    {
        $rent_date = Carbon::now()->toDateString();

        $return_date = Carbon::now()->addDay(3)->toDateString();

        try {

            $count = RentLogs::where('user_id', $request->user_id)->where('actual_return_date', NULL)->count();

            if($count >= 3){
                return redirect('/books/rent')->with('error', 'You have reached the limit of 3 rented books. Please return one to rent more.');
            }

            DB::beginTransaction();

            RentLogs::create([
                'user_id' => $request->user_id,
                'book_id' => $request->book_id,
                'rent_date' => $rent_date,
                'return_date' => $return_date,
            ]);

            $book = Book::where('id', $request->book_id)->first();
            $book->status = 'out of stock';
            $book->save();

            DB::commit();

            return redirect('/books/rent')->with('success', "You have successfully rented the book! Happy reading!");

        } catch (\Throwable $th) {

            DB::rollBack();

            return redirect('/books/rent')->with('error', 'Something went wrong!');

        }
    }
}
