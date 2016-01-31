<?php

namespace App\Http\Controllers;

use JavaScript;
use App\Http\Requests;
use Ravarin\Entities\Place;
use Illuminate\Http\Request;
use Ravarin\Entities\Category;
use App\Http\Controllers\Controller;

class PlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Place::with('categories')->get();
        $output = [];
        
        foreach($result as $place) {
            $output[] = [
                'name' => $place->title,
                'excerpt' => str_limit($place->excerpt),
                'thumbnail' => asset($place->thumbnail),
                'categories' => $place->categories->lists('id')->toArray(),
                'url' => place_path($place)
            ];
        }

        $places = collect($output);

        $categories = Category::getRootsLevelWithChildren();

        return view('places.index', compact('places', 'categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($lang='th', $slug)
    {
        $place = Place::findBySlug($slug);

        $place->increment('view');

        return view('places.show', compact('place'));
    }
}
