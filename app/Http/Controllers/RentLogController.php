<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\RentLogs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class RentLogController extends Controller
{
    public function rentLogs()
    {
        $rentLogs = RentLogs::with(['user', 'book'])->get();
        if ($rentLogs->isEmpty()) {
            return view('rent-log', ['rentLogs' => [], 'book' => null]);
        }
        return view('rent-log', ['rentLogs' => $rentLogs]);
    }

    public function returnBook($id)
    {
        $rentLog = RentLogs::with(['user', 'book'])->findOrFail($id);

        $rentLog->actual_return_date = Carbon::now();
        $rentLog->save();

        if (!$rentLog) {
            return redirect('/rent-log')->with('error', 'Rent log not found.');
        }

        $book = Book::findOrFail($rentLog->book_id);
        $book->status = 'in stock';
        $book->save();

        return redirect('/rent-logs')->with('success', 'The book has been successfully returned. Thank you!');
    }

}
