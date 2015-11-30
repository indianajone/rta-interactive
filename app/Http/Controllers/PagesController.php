<?php

namespace App\Http\Controllers;

use JavaScript;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function about() 
    {
        $photos = [ 
            [ 'title' => 'เกี่ยวกับเรา', 'src' =>  asset('images/tmp/about.jpg') ]
        ];

        Javascript::put(compact('photos'));

        return view('pages.about');
    }

    public function map() 
    { 
        $config = trans('map.waypoints.things');
        $options = [];

        foreach ($config as $value => $name) {
            $options[] = [
                'name' => $name,
                'value' => $value,
                'selected' => false
            ];
        }

        $options = json_encode($options);
        
        return view('pages.map', compact('options'));
    }
}
