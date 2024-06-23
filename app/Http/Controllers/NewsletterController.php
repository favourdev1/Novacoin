<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
public function subscribe(Request $request){
    // Validate the email field
    $request->validate([
        'email' => 'required|email'
    ]);

    // Check if the email already exists in the newsletter subscriptions
    $newsLetter = Newsletter::where('email', $request->email)->first();

    // If it doesn't exist, create a new subscription
    if(!$newsLetter){
        Newsletter::create([
            'email' => $request->email
        ]);
    }
}
}
