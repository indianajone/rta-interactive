<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use Ravarin\Entities\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ravarin\Services\AddPlacePanorama;

class PanoramaController extends Controller
{
    public function store($id, Request $request) 
    {
        $place = Place::findOrFail($id);

        (new AddPlacePanorama($place))->make($request->file('panorama'));
    }
}
