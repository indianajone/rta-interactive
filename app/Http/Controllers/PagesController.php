<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Ravarin\Entities\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function about() 
    {
        return view('pages.about');
    }

    public function map() 
    { 
        $config = trans('map.waypoints.things');
        $options = [];

        foreach ($config as $value => $name) {
            $options[] = [
                'name' => $name,
                'value' => $value,
                'selected' => false
            ];
        }

        $options = json_encode($options);
        
        return view('pages.map', compact('options'));
    }

    public function recommended() 
    {
        $places = Place::where('recommended', true)->paginate();

        return view('pages.recommended', compact('places'));
    }
}
