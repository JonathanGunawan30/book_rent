<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\RentLogs;
use App\Models\User;
use Illuminate\Http\Request;

class RentLogController extends Controller
{
    public function rentLogs()
    {
        $rentLogs = RentLogs::with(['user', 'book'])->get();

        return view('rent-log', ['rentLogs' => $rentLogs]);
    }
}
