<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('staff.index'))
                ->with('success', 'Welcome back, ' . Auth::user()->name . '!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'You have been logged out successfully.');
    }

    public function createDefaultUser()
    {
        if (User::where('email', 'admin@francisraj.com')->exists()) {
            return redirect()->route('login')
                ->with('error', 'Admin user already exists. Please login.');
        }
        User::create([
            'name' => 'Francis Raj S R',
            'email' => 'admin@francisraj.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        return redirect()->route('login')
            ->with('success', 'Admin user created! Email: admin@francisraj.com, Password: password123');
    }
}