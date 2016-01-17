<?php

namespace App\Http\Controllers;

use JavaScript;
use App\Http\Requests;
use Ravarin\Entities\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index() 
    {
        $places = Place::latest()->limit(9)->get();

        // Take one of each latest photo from places.
        $slideshow = $places->map(function ($place) {
            return $place->photos->sortByDesc('created_at')->first();
        });

        return view('home', compact('places', 'slideshow'));
    }
}
