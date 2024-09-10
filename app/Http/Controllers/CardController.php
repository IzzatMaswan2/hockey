<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cards;

class CardController extends Controller
{
    public function index()
    {
        $cards = Cards::all();
        return view('dashboard', compact('card_type','count'));
    }
}
