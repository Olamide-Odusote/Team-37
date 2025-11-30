<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Show the sign-in form.
     */
    public function showSigninForm()
    {
        return view('auth/signin');
    }

    /**
     * Handle the sign-in request.
     */
    public function signin(Request $request)
    {
        // Validate the request
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        

        // Attempt to authenticate the user
        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/'); // Redirect to intended page or home page 
}
        // Authentication failed
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
