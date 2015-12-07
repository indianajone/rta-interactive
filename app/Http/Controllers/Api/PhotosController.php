<?php

namespace App\Http\Controllers\Api;

use File;
use App\Http\Requests;
use Ravarin\Entities\Place;
use Illuminate\Http\Request;
use App\Ravarin\Entities\Photo;
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
     * Update the specified resource from storage.
     *
     * @param  int  $id
     * @param  int  $photoId
     * @return \Illuminate\Http\Response
     */
    public function update($id, $photoId)
    {
        $place = Place::findOrFail($id);

        $photo = $place->photos()->findOrFail($photoId);
        
        Photo::where([
                'place_id' => $id,
                'thumbnail' => true
            ])
            ->get()->each(function ($photo) {
                $photo->thumbnail = false;
                $photo->save();
            });

        $photo->thumbnail = true;
        $photo->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  int  $photoId
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $photoId)
    {
        $photo = Place::findOrFail($id)->photos()->findOrFail($photoId);

        File::delete([
            $photo->path, $photo->thumbnail_path
        ]);

        $photo->delete();
    }
}
