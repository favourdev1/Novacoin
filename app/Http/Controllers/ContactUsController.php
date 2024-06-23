<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.contact.index');
    }



    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        $user = Auth::user();
        $contactUs = new ContactUs;
        if ($user) {
            $contactUs->user_id = $user->id;
        }
        $contactUs->name = $validatedData['name'];
        $contactUs->email = $validatedData['email'];
        $contactUs->message = $validatedData['message'];
        $contactUs->save();

        return response()->json(['message' => 'Thank you for your message. We will get back to you soon!'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactUs $contactUs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactUs $contactUs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContactUs $contactUs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
public function destroy(ContactUs $contactUs)
{
    $contactUs->delete();

    return redirect()->route('contactUs.index')
                     ->with('success', 'ContactUs deleted successfully');
}
}
