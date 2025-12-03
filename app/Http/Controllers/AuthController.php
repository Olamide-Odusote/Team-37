<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /* SIGN IN (CUSTOMER) */

    public function showSigninForm()
    {
        return view('auth.signin');
    }

    public function signin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Attempt customer login
        if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        // Attempt admin login
        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/inventory');
        }

        return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
    }


    /* CUSTOMER REGISTRATION */

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|string|min:6|confirmed',
        ]);

        // Create customer account
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Account created successfully.');
    }


    /* ADMIN REGISTRATION (Only used by team, not public-facing) */

    public function showAdminRegistrationForm()
    {
        return view('auth.admin-register');
    }

    public function registerAdmin(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:admins,email',
            'password'              => 'required|string|min:6|confirmed',
        ]);

        Admin::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('signin')->with('success', 'Admin account created successfully.');
    }


    /* ======================================================
     |  PASSWORD RESET (SIMPLE INTERNAL VERSION)
     ====================================================== */

    public function showPasswordResetForm()
    {
        return view('auth.password-reset');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'email'                 => 'required|email',
            'password'              => 'required|min:6|confirmed',
        ]);

        // Find user
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No account found with that email.'])->withInput();
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('signin')->with('success', 'Password updated successfully.');
    }


    /* SIGN OUT */

    public function signout(Request $request)
    {
        // Log out both guards safely
        Auth::guard('web')->logout();
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
