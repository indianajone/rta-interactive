<?php

namespace App\Http\Controllers\Cms;

use App\Http\Requests;
use Ravarin\Entities\Ceo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function showCeo(Ceo $ceo) 
    {
        return view('cms.ceo.edit', compact('ceo'));
    }

    public function updateCeo(Request $request) 
    {
        $this->validate($request, [
            'name' => 'required',
            'position' => 'required',
            'image' => 'image',
            'description' => 'required'
        ]);

        dd($request);
    }
}
