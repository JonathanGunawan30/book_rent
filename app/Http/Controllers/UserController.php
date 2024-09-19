<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        return view('profile');
    }

    public function users()
    {
        $users = User::where('role_id', 2)->where('status', 'active')->get();
        return view('user', ['users' => $users]);
    }

    public function userRegistered()
    {
        $users = User::where('role_id', 2)->where('status', 'inactive')->get();
        return view('user-registered', ['users' => $users]);
    }

    public function userDetail($slug)
    {
        $users = User::where('slug', $slug)->first();
        return view('user-detail', ['user' => $users]);
    }

    public function userApprove($slug)
    {
        $sukses = false;

        $user = User::where('slug', $slug)->first();
        if (!$user) {
            return redirect('/users')->with('error', 'User not found!');
        }

        if ($user->status == 'inactive') {
            $user->status = 'active';
            $user->save();
            $sukses = true;
        }
        if ($sukses) {
            return redirect('/users')->with('success', 'User approved successfully');
        } else {
            return redirect('/users')->with('error', 'Something went wrong!');
        }
    }

    public function userDeactivate($slug)
    {
        $sukses = false;

        $user = User::where('slug', $slug)->first();
        if (!$user) {
            return redirect('/users')->with('error', 'User not found!');
        }

        if ($user->status == 'active') {
            $user->status = 'inactive';
            $user->save();
            $sukses = true;
        }

        if ($sukses) {
            return redirect('/users')->with('success', 'User deactivate successfully');
        }
        else {
            return redirect('/users')->with('error', 'Something went wrong!');
        }
    }

    public function userDelete($slug)
    {
        $user = User::where('slug', $slug)->first();
        if (!$user) {
            return redirect('/users')->with('error', 'User not found!');
        }

        $user->delete();
        if($user->status == 'inactive'){
            return redirect('/users/registered')->with('success', 'User deleted successfully');
        }

        return redirect('/users')->with('success', 'User deleted successfully');
    }

    public function userDeleted()
    {
        $user = User::onlyTrashed()->get();
        return view ('user-deleted', ['users' => $user]);
    }

    public function userRestore($slug)
    {
        $user = User::onlyTrashed()->where('slug', $slug)->first();
        if (!$user) {
            return redirect('/users')->with('error', 'User not found!');
        }

        $user->restore();
        if($user->status == 'inactive'){
            return redirect('/users/registered')->with('success', 'User restored successfully');
        }
        return redirect('/users')->with('success', 'User restored successfully');
    }

}
