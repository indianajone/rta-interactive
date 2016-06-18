<?php

namespace App\Http\Controllers;

use Ravarin\Entities\Page;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Page $pages) 
    {
        $page = $pages->where('name', 'home')->with(['places' => function ($query) {
            return $query->latest()->limit(9);
        }])->first();

        return view('home', [
            'places' => $page->places,
            'slideshow' => $page->slides()->get()
        ]);
    }
}
