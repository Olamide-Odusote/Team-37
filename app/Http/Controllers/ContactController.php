<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
     public function about()
    {
        return view('contact.about'); 
    }

    public function contact()
    {
        return view('contact.contact'); 
    }
}
