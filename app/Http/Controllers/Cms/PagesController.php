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

    public function updateCeo(Request $request, Ceo $ceo) 
    {
        $this->validate($request, [
            'th_name' => 'required',
            'th_position' => 'required',
            'th_description' => 'required',
            'image' => 'image'
        ]);
        
        $ceo->update($this->transformDataFromRequest($request));

        return redirect()->route('cms.ceo_path');
    }

    private function transformDataFromRequest(Request $request) 
    {
        $data = [];
        
        foreach ($request->all() as $key => $value) {
            if (starts_with($key, 'th')) {
                list($lang, $attribute) = explode('_', $key);
                $data[$lang][$attribute] = $value;
            }
            if (starts_with($key, 'en')) {
                list($lang, $attribute) = explode('_', $key);
                $data[$lang][$attribute] = $value;
            }
        }

        return $data;
    }
}
