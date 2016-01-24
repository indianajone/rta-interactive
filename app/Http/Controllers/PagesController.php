<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Ravarin\Entities\Page;
use Ravarin\Entities\Place;
use Illuminate\Http\Request;
use Ravarin\Entities\nearby;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function about() 
    {
        $page = Page::where('name', 'about')->first();

        return view('pages.about', compact('page'));
    }

    public function map($lang=null, $slug=null) 
    { 
        $config = trans('map.waypoints.things');
        $options = [];
        $place = null;
        $nearby = Nearby::all();

        if ($slug) {
            $place = Place::findBySlug($slug);
        }

        foreach ($config as $value => $name) {
            $options[] = [
                'name' => $name,
                'value' => $value,
                'selected' => false
            ];
        }

        $options = json_encode($options);
        
        return view('pages.map', compact('options', 'place', 'nearby'));
    }

    public function recommended() 
    {
        $places = Place::where('recommended', true)->paginate();

        return view('pages.recommended', compact('places'));
    }
}
