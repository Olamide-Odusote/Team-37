<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    public function show($name) {
        $admin = Admin::find($name);
        return view('/show', array('admin' => $admin));
    }
}
