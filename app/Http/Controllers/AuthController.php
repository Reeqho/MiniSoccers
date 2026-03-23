<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // $test = Auth::attempt($credentials);

        // dd($credentials);
        // dd($test);
        // die();


        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role == "admin") {
                session(['role' => 'admin']);
                return redirect()->intended('/dashboard');
            } else {
                session(['role' => 'customer']);
                return redirect()->intended('/');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session()->forget('role');
        return redirect('login');
    }

    // register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // validate
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'customer'
        ]);

        // success message to login page
        if ($user) {
            return redirect()->route('login')->with('success', 'Registration successful. Please login.');
        } else {
            return back()->with('error', 'Registration failed. Please try again.');
        }
    }
}
