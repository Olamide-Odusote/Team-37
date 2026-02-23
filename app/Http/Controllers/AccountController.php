<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Customer;

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
        $user = Auth::user();
        $customer = $user->customer;
        
        $request->validate([
            'Name' => 'required|string|max:255',
            'Email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'Mobile Number' => 'nullable|string|max:20',
            ]);
            
            // Update users table (for login)
            $user->email = $request->Email;
            $user->save();

            // Update customers table (profile data)
            $customer->update([
            'Name' => $request->Name,
            'Email' => $request->Email,
            'Mobile Number' => $request->input('Mobile_Number'),
            ]);

            return redirect()->route('account.index')
            ->with('success', 'Account details updated successfully.');
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
        'new_password' => 'required|min:8|confirmed',
    ]);

    $user = auth()->user();

    if (!Hash::check($request->current_password, $user->password)) {
        throw ValidationException::withMessages([
            'current_password' => 'Current password is incorrect.',
        ]);
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return back()->with('success', 'Password updated successfully.');
}

        public function destroy()
{
    $user = Auth::user();
    $customer = $user->customer;

    $customer->update([
        'is_active' => 0
    ]);

    $user->update([
        'is_active' => 0
    ]);

    Auth::logout();

    return redirect('/')
        ->with('success', 'Account deactivated successfully.');
}
                }
