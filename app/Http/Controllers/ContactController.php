<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Show the about page.
     */
     public function about()
    {
        return view('contact.about'); 
    }
    /**
     * Show the contact page.
     */
    public function contact()
    {
        return view('contact.contact'); 
    }
}
