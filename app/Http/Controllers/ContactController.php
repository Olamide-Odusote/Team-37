<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;            
use App\Mail\ContactAutoReply;                     
use App\Mail\ContactReceived;   

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
    /**
     * Handle contact form submission.
     */
    public function submit(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Mail::to(config('mail.from.address'))
        ->send(new ContactReceived($validated));

         Mail::to($validated['email'])
         ->send(new ContactAutoReply($validated['name']));

         // Here you can handle the submission, e.g., send an email or store in the database
        return redirect()->route('home')->with('success', 'Your message has been sent successfully!');
  }
}
