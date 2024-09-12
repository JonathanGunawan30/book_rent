<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login ()
    {
        return view('login');
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/login');
    }

    public function register ()
    {
        return view('register');
    }

    public function authenticating (Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'max:100'],
            'password' => ['required', 'max:100'],
        ]);

        if (Auth::attempt($credentials)) {
            if(Auth::user()->status != 'active'){
                Session::flash('error', 'Your account is not active yet. Please contact admin to activate your account.');
                return redirect('/login');
            }

//            $request->session()->regenerate();
            if(Auth::user()->role_id === 1){
                return redirect('dashboard');
            } else {
                return redirect('profile');
            }
        }

        Session::flash('error', 'Username and password do not match.');
        return redirect('/login');
    }
}
