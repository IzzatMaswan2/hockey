<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    // Show the form
    public function showForm()
    {
        return view('contact');
    }

    // Handle form submission
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'phone' => 'required|string|max:12',
            'email' => 'required|email|max:50',
            'subject' => 'required|string',
        ]);

        // Create a new message record
        Message::create([
            'name' => $validated['name'],
            'phone_number' => $validated['phone'],
            'email' => $validated['email'],
            'message' => $validated['subject'],
        ]);

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}
