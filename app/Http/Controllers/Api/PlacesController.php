<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use Ravarin\Entities\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlacesController extends Controller
{
    public function index() 
    {
        return Place::all();
    }
}
