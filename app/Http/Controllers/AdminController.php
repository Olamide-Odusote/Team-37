<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminController extends Controller
{
    /**
     * Display the specified admin.
     */
    public function show($name) {
        $admin = Admin::find($name);
        return view('/show', array('admin' => $admin));
    }
    /**
     * Display a listing of all admins.
     */
    public function list() {
        return view('/list', array('admins'=>Admin::all()));
    }

    /**
     * Show the form for changing the admin's password.
     */
    public function showChangePasswordForm(){
        return view('admin.change-password');
    }

    /**
     * Handle the password change request.
     */
    public function changePassword(Request $request){
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($request->current_password, $admin->Password)) {
            throw ValidationException::withMessages([
                'current_password' => 'Current password is incorrect.',
            ]);
        }

        $admin->update([
            'Password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('home')->with('success', 'Password changed successfully.');
    }
}