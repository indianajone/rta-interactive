<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use Ravarin\Entities\Place;
use Illuminate\Http\Request;
use Ravarin\Services\AddPlacePhoto;
use App\Http\Controllers\Controller;

class PhotosController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $place = Place::findOrFail($id);
        
        (new AddPlacePhoto($place))->make($request->file('photo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $photoId)
    {
        $place = Place::findOrFail($id);

        $place->photos()->findOrFail($photoId)->delete();
    }
}
