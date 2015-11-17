<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Ravarin\Entities\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index() 
    {
        $places = Place::all();
        
        return view('home', compact('places'));
    }
}
