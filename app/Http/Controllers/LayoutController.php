<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function footer() 
    {
        $footer = Footer::where('footer_id',1);

        // dd($footer);
        return view('profile.partials.footer', [
            'footer' => $footer
        ]);
    }
}
