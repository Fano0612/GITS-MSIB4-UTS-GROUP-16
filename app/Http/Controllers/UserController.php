<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register()
    {
        $data['title'] = "Register";
        return view('register', $data);
    }

    public function registeracc(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:userlist',
            'email' => 'required|unique:userlist',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'access_rights' => 'required',
        ], [
            'username.required' => 'Username is required',
            'username.unique' => 'Username already exists',
            'email.required' => 'Email is required',
            'email.unique' => 'Email already exists',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 6 characters',
            'password_confirmation.required' => 'Confirm Password is required',
            'password_confirmation.same' => 'Passwords do not match',
            'access_rights.required' => 'Access is required',
        ]);

        $user = new User([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'access_rights' => $request->access_rights,
        ]);

        $existing_user = User::where('username', $request->username)
            ->orWhere('email', $request->email)
            ->first();
        if ($existing_user) {
            if ($existing_user->username == $request->username) {
                return redirect()->back()->withErrors(['username' => 'Username already exists'])->withInput();
            }
            if ($existing_user->email == $request->email) {
                return redirect()->back()->withErrors(['email' => 'Email already exists'])->withInput();
            }
        }

        $user->save();
        return redirect()->route('login')->with('success', 'Data Successfully Registered');
    }

    public function login()
    {
        $data['title'] = "Login";
        return view('login', $data);
    }

    public function loginacc(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password']
        ])) {

            $user = Auth::user();
            if ($user && $user->status === 'inactive') {
                $user->status = 'active';
                $user->save();
                $request->session()->regenerate();

                return redirect()->intended('homepage');
            }
        }

        return back()->withErrors([
            'email' => 'Email or Password is incorrect',
        ]);
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user->status = 'inactive';
            $user->save();
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        return view('login');
    }


    public function AccountExist()
    {
        return view('login');
    }
    public function AccountUnexist()
    {
        return view('register');
    }
}
