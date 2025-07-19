<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showSignup()
    {
        return view('signup');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'repassword' => 'required|same:password'
        ]);



        if (User::where('email', $request->email)->exists()) {
            return redirect('/signup')->with('error', 'User already exists!');
        }
        if ($request->email === 'avanishpatel3434@gmail.com') {
            return redirect('/signup')->with('error', 'this email can not be use');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Session::put('user', $request->email);
        return redirect('/my-posts');
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

        if (!$user) {
            return redirect('/login')->with('error', 'User not found. Please create an account.');
        }
        if (!Hash::check($request->password, $user->password)) {
            return redirect('/login')->with('error', 'Invalid email or password');
        }

        Session::put('user', $user->email);

        if ($user->email === 'avanishpatel3434@gmail.com') {
            return redirect('/posts');
        }


        return redirect('/my-posts');
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}
