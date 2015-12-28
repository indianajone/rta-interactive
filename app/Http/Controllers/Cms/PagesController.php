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
        $ceo = $ceo->where('name', 'ceo')->first();

        return view('cms.ceo.edit', compact('ceo'));
    }

    public function updateCeo(Request $request, Ceo $ceo) 
    {
        $this->validate($request, [
            'fullname:th' => 'required',
            'position:th' => 'required',
            'description:th' => 'required',
            'image' => 'image'
        ]);

        $ceo = $ceo->where('name', 'ceo')->with('translations')->first();    
        $ceo->update($request->all());
        // $ceo->updateImage($request->get('image'));

        // dd($ceo->toArray());

        return redirect()->route('cms.ceo_path');
    }
}
