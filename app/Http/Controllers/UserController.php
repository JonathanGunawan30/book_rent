<?php

namespace App\Http\Controllers;

use App\Models\RentLogs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $users = Auth::user();
        $rentLogs = RentLogs::with(['user', 'book'])->where('user_id', $users->id )->get();
        return view('profile', ['user' => $users, 'rentLogs' => $rentLogs]);
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
        $rentLogs = RentLogs::with(['user', 'book'])->where('user_id', $users->id )->get();
        return view('user-detail', ['user' => $users, 'rentLogs' => $rentLogs]);
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

    public function editProfile()
    {
        $user = Auth::user();
        return view('edit-profile', ['user' => $user]);
    }

    public function editProfilePUT(Request $request)
    {
        $id = Auth::user()->id;

        $user = User::findOrFail($id);

        $request->validate([
            'username' => ['required', 'max:255', 'min:3',  Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable','max:20','min:5', 'regex:/^\d+$/'],
            'address' => ['required', 'max:255', 'min:3'],
        ]);

        $user = Auth::user();
        $phone = preg_replace('/\D/', '', $request->phone);
        $user->update(array_merge($request->except('phone'), ['phone' => $phone]));

        return redirect('/profile')->with('success', 'Profile updated successfully');
    }

    public function changePassword()
    {
        return view('change-password');
    }

    public function changePasswordPOST(Request $request)
    {
        $request->validate([
            'new_password' => 'required|max:255|min:6',
            'confirm_password' => 'required|max:255|min:6|same:new_password',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect('/profile')->with('success', 'Password updated successfully');
    }


}
