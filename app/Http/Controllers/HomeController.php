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
        $slideshow = [];

        return view('home', compact('places', 'slideshow'));
    }

    private function generateSlideShow($places) 
    {
        $place = $places->first();

        if ($place) {
            $place->photos->sortByDesc('created_at')->map(function($photo) {
                return [
                    'title' => $photo->place->name,
                    'src' => asset($photo->path)
                ];
            })->toArray();

            Javascript::put(compact('photos'));
        }
    }
}
