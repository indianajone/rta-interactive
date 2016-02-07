<?php

namespace App\Http\Controllers\Cms;

use App\Http\Requests;
use Ravarin\Entities\Place;
use Ravarin\Entities\Category;
use App\Ravarin\Entities\Photo;
use Ravarin\Services\AddPlacePhoto;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use App\Http\Requests\Cms\PlaceRequest;
use Ravarin\Translations\TranslationTransformer;

class PlacesController extends Controller
{
    protected $transformer;

    public function __construct(TranslationTransformer $transformer) 
    {
        $this->middleware('auth');

        $this->transformer = $transformer;
        
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::orderBy('recommended', 'desc')
                        ->latest()
                        ->paginate();

        return view('cms.places.index', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereNotNull('parent_id')->get();

        return view('cms.places.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Cms\PlaceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlaceRequest $request)
    {
        
        $place = $this->createPlace($request);

        flash()->success('Success!', "$place->name has been created.");

        return redirect(route('cms.places.edit', $place->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $place = Place::find($id);

        return view('cms.places.edit', compact('place'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Cms\PlaceRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlaceRequest $request, $id)
    {
        $place = $this->updatePlace(Place::find($id), $request);

        flash()->success('Update!', "$place->name has been updated.");

        return redirect(route('cms.places.edit', $place->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place = Place::findOrFail($id);
        
        $place->delete();

        flash()->success('Deleted!', "$place->title has been deleted.");

        return redirect(route('cms.places.index'));
    }

    private function createPlace (PlaceRequest $request) 
    {
        $place = Place::create($this->transformer->transform($request->all()));

        $place->categories()->attach($request->get('categories'));

        (new AddPlacePhoto($place))->make($request->file('photo'));

        return $place;
    }

    private function updatePlace (Place $place, PlaceRequest $request)
    {
        $place->update($this->transformer->transform($request->all()));

        $place->categories()->sync($request->get('categories'));

        (new AddPlacePhoto($place))->make($request->file('photo'));

        return $place;
    }
}
