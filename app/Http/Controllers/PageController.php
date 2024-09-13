<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Contact;
use App\Models\ContactEmail;
use App\Models\ContactPhoneNumber;
use App\Models\Achievement;
use App\Models\Home;
use App\Models\MeetTeam;

class PageController extends Controller
{
    // show all
    public function showpage()
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

        // collect all for the contact section in array - contact . panggil {{$contactArr['contact']->location}}
        $contactArr = [
            'contact' => $contactinfo,
            'phones' => $phoneinfo,
            'emails' => $emailinfo
        ];

        // about section
        $about = About::where('about_id', 1)->first();

        $home = Home::where('home_id', 1)->first();
        $homeAchievement = Achievement::where('home_id', 1)->take(4)->get(); 
        $homeMeet = MeetTeam::where('home_id', 1)->take(4)->get(); 

        $homeArr = [
            'home' => $home,
            'Achievement' => $homeAchievement ,
            'meet' => $homeMeet ,
        ]; 

        // dd($homeArr['Achievement']);

        return view('admin.page', [
            'contactArr' => $contactArr,
            'about' => $about,
            'homeArr' => $homeArr
        ]);
    }

    // Home area 
    public function updateHome(Request $request, $id)
    {
        $request->validate([
            'banner_s_header' => 'required|string|max:50',
            'banner_b_header' => 'required|string|max:50',
            'banner_paragraph' => 'required|string',
        ]);

        $home = Home::findOrFail($id);
        $home->banner_s_header = $request->input('banner_s_header');
        $home->banner_b_header = $request->input('banner_b_header');
        $home->banner_paragraph = $request->input('banner_paragraph');
        $home->save();

        return redirect()->route('show.page')->with('success', 'Contact information updated successfully!');
    }

    // Update Achivement
    public function updateAchievements(Request $request)
    {
        // Validate the request
        $request->validate([
            'achievements.*.achievement_id' => 'required|integer|exists:achievement,achievement_id',
            'achievements.*.title' => 'required|string|max:255',
            'achievements.*.description' => 'required|string|max:255',
            'achievements.*.icon' => 'required|string|max:255',
            'achievements.*.home_id' => 'required|integer|exists:home,home_id',
        ]);

        // Loop through each achievement and update
        foreach ($request->input('achievements') as $achievementData) {
            $achievement = Achievement::findOrFail($achievementData['achievement_id']);
            $achievement->title = $achievementData['title'];
            $achievement->description = $achievementData['description'];
            $achievement->icon = $achievementData['icon'];
            $achievement->home_id = $achievementData['home_id'];
            $achievement->save();
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Achievements updated successfully!');
    }

    // Update Meet Team
    public function updateMeetTeam(Request $request)
    {
        // Validate the request
        $request->validate([
            'meet_id.*' => 'required|integer|exists:meet_team,meet_id',
            'name.*' => 'required|string|max:100',
            'position.*' => 'required|string|max:100',
            'img.*' => 'required|string|max:100',
            'link1.*' => 'nullable|string|max:100',
            'link2.*' => 'nullable|string|max:100',
            'link3.*' => 'nullable|string|max:100',
            'icon_link1.*' => 'nullable|string|max:100',
            'icon_link2.*' => 'nullable|string|max:100',
            'icon_link3.*' => 'nullable|string|max:100',
            'home_id' => 'required|integer|exists:home,home_id',
        ]);

        // Loop through each MeetTeam to update
        foreach ($request->input('meet_id') as $index => $id) {
            $meetTeam = MeetTeam::findOrFail($id);
            $meetTeam->name = $request->input('name')[$index];
            $meetTeam->position = $request->input('position')[$index];
            $meetTeam->img = $request->input('img')[$index];
            $meetTeam->link1 = $request->input('link1')[$index];
            $meetTeam->link2 = $request->input('link2')[$index];
            $meetTeam->link3 = $request->input('link3')[$index];
            $meetTeam->icon_link1 = $request->input('icon_link1')[$index];
            $meetTeam->icon_link2 = $request->input('icon_link2')[$index];
            $meetTeam->icon_link3 = $request->input('icon_link3')[$index];
            $meetTeam->home_id = $request->input('home_id');
            $meetTeam->save();
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Meet Team members updated successfully!');
    }


    // About setcion 
    public function updateAbout(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'banner' => 'required|string',
            'we_are' => 'required|string',
            'we_offer' => 'required|string',
        ]);
    
        // Retrieve the 'About' model instance with ID 1
        $about = About::find(1);
    
        // Check if the 'About' instance was found
        if ($about) {
            // Update the model's attributes with the new values
            $about->banner = $request->input('banner');
            $about->we_are = $request->input('we_are');
            $about->we_offer = $request->input('we_offer');
            
            // Save the updated model to the database
            $about->save();
            
            // Redirect with a success message
            return redirect()->route('show.page')->with('success', 'About information updated successfully!');
        } else {
            // Handle the case where the 'About' instance was not found
            return redirect()->route('show.page')->with('error', 'About section not found.');
        }
    }


    //  Contact Section 
    public function storeContact(Request $request)
    {
        $contact = Contact::create($request->only(['name', 'location']));

        // Handle phone numbers
        if ($request->has('phone_numbers')) {
            foreach ($request->phone_numbers as $phone_number) {
                $contact->phoneNumbers()->create(['phone_number' => $phone_number]);
            }
        }

        // Handle emails
        if ($request->has('emails')) {
            foreach ($request->emails as $email) {
                $contact->emails()->create(['email' => $email]);
            }
        }

        return response()->json($contact);
    }

    public function showContact($id)
    {
        $contact = Contact::with(['phoneNumbers', 'emails', 'location'])->findOrFail($id);
        return response()->json($contact);
    }

    public function showcontactinfo()
    {
        $contactinfo = Contact::where('contact_id', 1)->first();
        $contactphone = ContactPhoneNumber::where('contact_id', 1)->take(2)->get();
        $contactemail = ContactEmail::where('contact_id', 1)->take(2)->get();

        // Use default values if empty
        $emailinfo = $contactemail->pluck('email')->toArray();
        $phoneinfo = $contactphone->pluck('phone_number')->toArray();

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
            'phone_numbers.*.id' => 'required|integer|exists:contactphone,phone_id',
            'phone_numbers.*.number' => 'nullable|string',
            'emails.*.id' => 'required|integer|exists:contactemail,email_id',
            'emails.*.address' => 'nullable|email',
        ]);

        $contact = Contact::where('contact_id', 1)->firstOrFail();
        $contact->location = $request->input('location');
        $contact->save();

        // Update phone numbers
        if ($request->has('phone_numbers')) {
            foreach ($request->input('phone_numbers') as $phoneData) {
                ContactPhoneNumber::updateOrCreate(
                    ['phone_id' => $phoneData['id']],
                    [
                        'contact_id' => 1,
                        'phone_number' => $phoneData['number']
                    ]
                );
            }
        }

        if ($request->has('emails')) {
            foreach ($request->input('emails') as $emailData) {
                ContactEmail::updateOrCreate(
                    ['email_id' => $emailData['id']],
                    [
                        'contact_id' => 1,
                        'email' => $emailData['address']
                    ]
                );
            }
        }
        return redirect()->route('show.page')->with('success', 'Contact information updated successfully!');
    }

}
