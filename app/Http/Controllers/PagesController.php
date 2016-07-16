<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Ravarin\Entities\Page;
use Ravarin\Entities\Place;
use Illuminate\Http\Request;
use Ravarin\Entities\Nearby;
use Ravarin\Entities\Category;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function about() 
    {
        $page = Page::where('name', 'about')->first();

        return view('pages.about', compact('page'));
    }

    public function map(Category $categories, $lang=null, $slug=null) 
    { 
        $config = trans('map.waypoints.things');
        $options = [];
        $place = null;
        $nearby = Place::with('categories', 'photos')->get()
                    ->map(function ($place) {
                        return [
                            'id' => $place->id,
                            'title' => $place->title,
                            'description' => $place->excerpt,
                            'latitude' => $place->latitude,
                            'longitude' => $place->longitude,
                            'categories' => $place->categories->map(function ($cat) {
                                return [
                                    'id' => $cat->id,
                                    'name' => $cat->name,
                                    'parent_id' => $cat->parent_id
                                ];
                            })
                        ];
                    });
        
        $categories = $categories->listsChildFromGroup($categories->first());

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
        
        return view('pages.map', compact('options', 'place', 'nearby', 'categories'));
    }

    public function recommended() 
    {
        $places = Place::where('recommended', true)->get();

         // Take one of each latest photo from places.
        $slideshow = $places->map(function ($place) {
            return $place->photos->sortByDesc('created_at')->first();
        });

        return view('pages.recommended', compact('places', 'slideshow'));
    }
}
