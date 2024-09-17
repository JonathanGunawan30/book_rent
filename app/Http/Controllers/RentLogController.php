<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RentLogController extends Controller
{
    public function rentLogs()
    {
        return view('rent-log');
    }
}
