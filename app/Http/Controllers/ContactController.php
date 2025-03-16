<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendEmail(Request $request)
    {
        // Validate the form data
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|max:255',
        //     'subject' => 'required|string|max:255',
        //     'message' => 'required|string',
        // ]);

        // Send the email
        Mail::to('FAIZANENTERPRISES.LOGISTICS@gmail.com')->send(new ContactMail($request->all()));

        // Redirect back with a success message
        return back()->with('success', 'Your message has been sent successfully! We will contact you soon');
    }
}
