<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Customer;
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

    /* SIGN IN (ADMIN) */

    public function showAdminSigninForm()
    {
        return view('auth.admin-signin');
    }

    /* SIGN IN (CUSTOMER) */

    public function signinCustomer(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'))->with('success', 'Signed in successfully!');
        }

        return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
    }

    /* SIGN IN (ADMIN) */

    public function signinAdmin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

       if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {

    $request->session()->regenerate();

    $admin = Auth::guard('admin')->user();

    $user = User::firstOrCreate(
    ['email' => $admin->Email],
    [
        'name' => $admin->Name,
        'password' => $admin->Password,
    ]
);

Auth::guard('web')->login($user);

    return redirect()->intended(route('admin.inventory.index'))
        ->with('success', 'Admin signed in successfully!');
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

        // Create corresponding customer record
        Customer::create([
            'user_id'   => $user->id,
            'Name'      => $request->name,
            'Email'     => $request->email,
            'Password'  => Hash::make($request->password),
            'Mobile Number' => 0,
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Account created successfully. Welcome to OmniCart!');
    }


    /* ADMIN REGISTRATION (Only used by team, not public-facing) */

    public function showAdminRegistrationForm()
    {
        return view('auth.admin-register');
    }

    public function registerAdmin(Request $request)
{
    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:admins,Email',
        'password' => 'required|string|min:6|confirmed',
    ]);

    // Create admin record
    $admin = Admin::create([
        'Name'     => $request->name,
        'Email'    => $request->email,
        'Password' => Hash::make($request->password),
    ]);

    // ALSO create a user record
    $user = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // ALSO create a customer record
    Customer::create([
        'user_id'  => $user->id,
        'Name'     => $request->name,
        'Email'    => $request->email,
        'Password' => Hash::make($request->password),
        'Mobile Number' => 0,
    ]);

    return redirect()->route('admin.signin')
        ->with('success', 'Admin account created successfully.');
}


    /* PASSWORD RESET (SIMPLE INTERNAL VERSION) */

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

        return redirect()->route('home')->with('success', 'You have been signed out successfully.');
    }
}
