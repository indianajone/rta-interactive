<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Http\Requests;
use Ravarin\Entities\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoritesController extends Controller
{
    public function store($id) 
    {
        Place::findOrFail($id)->favoriteUsers()->attach(Auth::id());
    }

    public function destroy($id) 
    {
        Place::findOrFail($id)->favoriteUsers()->detach(Auth::id());
    }
}
