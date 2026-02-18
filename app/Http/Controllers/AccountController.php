<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
    * Display the user's account overview.
    *
    * @return \Illuminate\View\View
    */
    public function index()
    {
        $user = Auth::user();
        $customer = $user->customer;
        return view('account.index', compact('customer'));
    }

    /**
     * Show the form for editing the user's account details.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $customer = Auth::user()->customer;
        return view('account.edit', compact('customer'));
    }

    /**
     * Update the user's account details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $customer = Auth::user()->customer;
        $request->validate([
            'Name' => 'required|string|max:255',
            'Email' => 'required|email|max:255|unique:customers,Email,' . $customer->Customer_ID . ',Customer_ID',
            'Mobile Number' => 'nullable|string|max:20',
        ]);

        $customer->update([
            'Name' => $request->input('Name'),
            'Email' => $request->input('Email'),
            'Mobile Number' => $request->input('Mobile Number'),
        ]);

        return redirect()->route('account.index')->with('success', 'Account details updated successfully.');
    }

        /**
        * Show the form for changing the user's password.
        *
        * @return \Illuminate\View\View
        */
    public function showChangePasswordForm()
    {
        return view('account.change-password');

        }

    /**
     * Change the user's password.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $customer = Auth::user()->customer;

        if (!password_verify($request->input('current_password'), $customer->Password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $customer->Password = bcrypt($request->input('new_password'));
        $customer->save();

        return redirect()->route('account.dashboard')->with('success', 'Password changed successfully.');
    }
}
