<?php

namespace App\Http\Controllers\Cms;

use App\Http\Requests;
use Ravarin\Entities\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ravarin\Translations\TranslationTransformer;
use Ravarin\Services\InterventionImageManager as ImageManager;

class PlacesMarkerController extends Controller
{
    protected $transformer;

    protected $images;

    public function __construct(TranslationTransformer $transformer, ImageManager $imageManager) 
    {
        $this->middleware('auth');

        $this->transformer = $transformer;

        $this->images = $imageManager;

        parent::__construct();    
    }

    public function store(Request $request, $placeId) 
    {
        $place = Place::find($placeId);
        $attachment = $place->markers()->create($this->transformer->transform($request->all()));

        // Upload and create thumbnail
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            
            $attachment->name = sha1(time() . '-' . $file->getClientOriginalName()) . '.' . $extension;
            $attachment->extension = $extension;
            $attachment->type = 'marker';
            
            $imageSize = @getimagesize($file->getPathname());
            
            if ($imageSize) {
                $attachment->width = $imageSize[0];
                $attachment->height = $imageSize[1];
            }

            $attachment->path = sprintf("%s/%s", 'uploaded/markers', $attachment->name);
            $attachment->thumbnail_path = sprintf("%s/tn-%s", 'uploaded/markers', $attachment->name);

            $this->images->make($file, $attachment->path);
            $this->images->thumbnail($file, $attachment->thumbnail_path);

            $attachment->save();
        }

        flash()->success('Created!', 'Maker has been created.');

        return redirect()->route('cms.places.edit', $placeId);
    }

    public function update(Request $request, $placeId, $id) 
    {
        $place = Place::find($placeId);
        
        $attachment =  $place->markers()->find($id);
        $attachment->update($this->transformer->transform($request->all()));

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            
            $attachment->name = sha1(time() . '-' . $file->getClientOriginalName()) . '.' . $extension;
            $attachment->extension = $extension;
            
            $imageSize = @getimagesize($file->getPathname());
            
            if ($imageSize) {
                $attachment->width = $imageSize[0];
                $attachment->height = $imageSize[1];
            }

            $attachment->path = sprintf("%s/%s", 'uploaded/markers', $attachment->name);
            $attachment->thumbnail_path = sprintf("%s/tn-%s", 'uploaded/markers', $attachment->name);

            $this->images->make($file, $attachment->path);
            $this->images->thumbnail($file, $attachment->thumbnail_path);

            \File::delete([
                $attachment->getOriginal('path'),
                $attachment->getOriginal('thumbnail_path') 
            ]);

            $attachment->save();
        }

        flash()->success('Update!', 'Maker has been updated.');

        return redirect()->route('cms.places.edit', $placeId);
    }
}
