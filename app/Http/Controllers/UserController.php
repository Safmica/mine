<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    public function showSignup()
    {
        return view('signup');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Session::put('user_id', $user->id);
        Cookie::queue('user_name', $user->name, 60 * 24 * 7);

        return redirect('/')->with('success', 'Signup berhasil!');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Email atau password salah']);
        }

        Session::put('user_id', $user->id);
        Cookie::queue('user_name', $user->name, 60 * 24 * 7);

        return redirect('/')->with('success', 'Login berhasil!');
    }

    public function logout()
    {
        Session::forget('user_id');
        Cookie::queue(Cookie::forget('user_name'));

        return redirect('/login')->with('success', 'Logout berhasil');
    }
}
