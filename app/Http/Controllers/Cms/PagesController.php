<?php

namespace App\Http\Controllers\Cms;

use App\Http\Requests;
use Ravarin\Entities\Ceo;
use Ravarin\Entities\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ravarin\Translations\TranslationTransformer;

class PagesController extends Controller
{
    protected $transformer;

    public function __construct(TranslationTransformer $transformer) 
    {
        $this->middleware('auth');

        $this->transformer = $transformer;

        parent::__construct();    
    }

    public function showAbout(Page $page) 
    {
        $page = $page->where('name', 'about')->first();

        return view('cms.about.edit', compact('page'));
    }

    public function updateAbout(Request $request, Page $page) 
    {
        $this->validate($request, [
            'title:th' => 'required',
            'body:th' => 'required'
        ]);
        
        $page->about()->update(
            $this->transformer->transform($request->all())
        );

        flash()->success('Update!', "About us page has been updated.");

        return redirect()->route('cms.about_path');
    }

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
        $ceo->updateImage($request->file('image'));

        flash()->success('Update!', "Ceo has been updated.");
        
        return redirect()->route('cms.ceo_path');
    }
}
