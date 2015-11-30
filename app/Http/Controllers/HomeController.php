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
        $places = Place::all();

        $this->generateSlideShow($places);
        
        return view('home', compact('places'));
    }

    private function generateSlideShow($places) 
    {
        $photos = $places->first()->photos->sortByDesc('created_at')->map(function($photo) {
            return [
                'title' => $photo->place->name,
                'src' => asset($photo->path)
            ];
        })->toArray();

        Javascript::put(compact('photos'));
    }
}
