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
        $places = Place::with('categories', 'translations', 'photos')->get()
                        ->map(function ($place) {
                            return [
                                'id' => $place->id,
                                'name' => $place->title,
                                'excerpt' => str_limit($place->excerpt),
                                'thumbnail' => asset($place->thumbnail),
                                'categories' => $place->categories->lists('id')->toArray(),
                                'url' => place_path($place),
                                'map_url' => map_path($place),
                                'favorited' => $place->hasFavoritedByUser($this->user)
                            ];
                        });

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
