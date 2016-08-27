<?php

namespace App\Http\Controllers\Cms;

use App\Http\Requests;
use Illuminate\Http\Request;
use Ravarin\Entities\Category;
use App\Http\Controllers\Controller;
use Ravarin\Translations\TranslationTransformer;

class CategoriesController extends Controller
{
    protected $transformer;

    public function __construct(TranslationTransformer $transformer) 
    {
        $this->middleware('auth');

        $this->transformer = $transformer;

        parent::__construct();    
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::getRootsLevelWithChildren();

        return view('cms.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $this->validate($request, [
            'name:th' => 'required'
        ]);

        $category = Category::create(
            $this->transformer->transform($request->all())
        );

        flash()->success('Success!', "$category->name has been created.");

        return redirect()->route('cms.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('cms.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $category->update(
            $this->transformer->transform($request->all())
        );

        flash()->success('Updated!', "$category->name has been updated.");

        return redirect()->route('cms.categories.edit', $category->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->children()->delete();        

        $category->delete();
    }
}
