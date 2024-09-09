<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactEmail;
use App\Models\ContactPhoneNumber;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $contact = Contact::create($request->only(['name', 'location']));

        foreach ($request->phone_numbers as $phone_number) {
            $contact->phoneNumbers()->create(['phone_number' => $phone_number]);
        }

        foreach ($request->emails as $email) {
            $contact->emails()->create(['email' => $email]);
        }

        return response()->json($contact);
    }

    public function show($id)
    {
        $contact = Contact::with(['phoneNumbers', 'emails', 'location'])->findOrFail($id);
        return response()->json($contact);
    }

    public function showcontactinfo()
    {
        $contactinfo = Contact::where('contact_id', 1)->first();
        $contactphone = ContactPhoneNumber::where('contact_id', 1)->take(2)->get();
        $contactemail = ContactEmail::where('contact_id', 1)->take(2)->get();
        $emailinfo = $contactemail ->pluck('email');
        $phoneinfo = $contactphone ->pluck('phone_number');
        
        return view('user.contact', [
            'contact' => $contactinfo,
            'phones' => $phoneinfo,
            'emails' => $emailinfo
        ]);
    }

    public function showContactInfo2()
    {
        $contactinfo = Contact::where('contact_id', 1)->first();
        $contactphone = ContactPhoneNumber::where('contact_id', 1)->get(); // Fetch all related phone numbers
        $contactemail = ContactEmail::where('contact_id', 1)->get(); // Fetch all related emails

        $emailinfo = $contactemail->mapWithKeys(function ($email) {
            return [$email->email_id => $email->email];
        })->toArray();

        $phoneinfo = $contactphone->mapWithKeys(function ($phone) {
            return [$phone->phone_id => $phone->phone_number];
        })->toArray();

        return view('admin.page', [
            'contact' => $contactinfo,
            'phones' => $phoneinfo,
            'emails' => $emailinfo
        ]);
    }

    public function updateContactInfo(Request $request)
    {
        $request->validate([
            'location' => 'required|string',
            'phone_numbers.*.id' => 'nullable|integer|exists:contactphone,phone_id',
            'phone_numbers.*.number' => 'required|string',
            'emails.*.id' => 'nullable|integer|exists:contactemail,email_id',
            'emails.*.address' => 'required|email',
        ]);

        // Update Contact location
        $contact = Contact::where('contact_id', 1)->first();
        $contact->location = $request->input('location');
        $contact->save();

        // Update phone numbers
        foreach ($request->input('phone_numbers') as $phoneData) {
            ContactPhoneNumber::updateOrCreate(
                ['phone_id' => $phoneData['id']], // Use phone_id as the primary key
                [
                    'contact_id' => 1,
                    'phone_number' => $phoneData['number']
                ]
            );
        }

        // Update emails
        foreach ($request->input('emails') as $emailData) {
            ContactEmail::updateOrCreate(
                ['email_id' => $emailData['id']], // Use email_id as the primary key
                [
                    'contact_id' => 1,
                    'email' => $emailData['address']
                ]
            );
        }

        return redirect()->route('contact.show')->with('success', 'Contact information updated successfully!');
    }

}

