<?php

// app/Http/Controllers/FaqController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Achievement;
use App\Models\Home;
use App\Models\MeetTeam;

class HomeController extends Controller
{
    public function Home()
    {
        // home section 
        $home = Home::where('home_id', 1)->first();
        $homeAchievement = Achievement::where('home_id', 1)->take(4)->get(); 
        $homeMeet = MeetTeam::where('home_id', 1)->take(4)->get(); 

        $homeArr = [
            'home' => $home,
            'Achievement' => $homeAchievement ,
            'meet' => $homeMeet ,
        ]; 

        $faqs = Faq::all();

        return view('user.Home', [
            'homeArr' => $homeArr,
            'faqs' => $faqs
        ]);
    }
}

