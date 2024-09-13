<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function registerProcess(Request $request)
    {
        $request->validate([
            'username' => ['required', 'max:255', 'unique:users', 'min:3'],
            'password' => ['required', 'max:255', 'min:8'],
            'phone' => ['nullable','max:20','min:5', 'regex:/^\d+$/'],
            'address' => ['required', 'max:255', 'min:3'],
        ]);

        $phone = preg_replace('/\D/', '', $request->phone); // regex

        $request['password'] = Hash::make($request->password);

//        User::create($request->all());
        User::create(array_merge($request->except('phone'), ['phone' => $phone])); // kalo ga regex gausah

        Session::flash('message', 'Registration successful! Please contact the admin to activate your account.');
        return redirect('/register');
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

            $request->session()->regenerate();
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
