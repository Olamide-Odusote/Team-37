<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
