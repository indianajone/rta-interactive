<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use Ravarin\Entities\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlacesController extends Controller
{
    public function index(Request $request) 
    {
        $places = Place::with('photos')->search($request->get('q', ''))->get();

        $results = $places->map(function ($place) {
            return [
                'name' => $place->name,
                'excerpt' => $place->excerpt,
                'thumbnail' => asset($place->thumbnail),
                'latitude' => $place->latitude,
                'longitude' => $place->longitude
            ];
        });

        return \Response::json($results);
    }
}
