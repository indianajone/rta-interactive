<?php

namespace App\Http\Controllers;

use Ravarin\Entities\Page;
use Ravarin\Entities\Place;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index() 
    {
        $page = Page::where('name', 'home')->first();

        $slideshow = $page->slides()->get();
     
        $places = Place::has('photos')->orderBy('view', 'desc')->limit(9)->get();

        return view('home', compact('places', 'slideshow'));
    }
}
