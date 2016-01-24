<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use Ravarin\Entities\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function index(Request $request) 
    {
        $search = Place::with('photos')->search($request->get('q', null))->get();
        $recommended = Place::with('photos')->recommended()->get();

        return \Response::json([
            'search' => $this->transform($search),
            'recommended' => $this->transform($recommended)
        ]);
    }

    private function transform($data) 
    {
        return $data->map(function ($place) {
            return [
                'name' => $place->title,
                'excerpt' => $place->excerpt,
                'thumbnail' => asset($place->thumbnail),
                'recommended' => $place->recommended,
                'rel' => place_path($place),
                'map' => map_path($place)
            ];
        });
    }
}


