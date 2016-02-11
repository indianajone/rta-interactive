<?php

namespace App\Http\Controllers\Cms;

use App\Http\Requests;
use Ravarin\Entities\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ravarin\Translations\TranslationTransformer;
use Ravarin\Services\InterventionImageManager as ImageManager;

class PlacesNearbyController extends Controller
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
        $nearby = $place->nearby()->create($this->transformer->transform($request->all()));
        
        $attachment = $nearby->photos()->firstOrCreate([]);

        $attachment->fill([
            'th' => ['title' => $nearby->translate('th')->title],
            'en' => ['title' => $nearby->translate('en')->title],
            'thumbnail' => true
        ]);

        // Upload and create thumbnail
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            
            $attachment->name = sha1(time() . '-' . $file->getClientOriginalName()) . '.' . $extension;
            $attachment->extension = $extension;
            $attachment->type = 'image';
            
            $imageSize = @getimagesize($file->getPathname());
            
            if ($imageSize) {
                $attachment->width = $imageSize[0];
                $attachment->height = $imageSize[1];
            }

            $attachment->path = sprintf("%s/%s", 'uploaded/nearby', $attachment->name);
            $attachment->thumbnail_path = sprintf("%s/tn-%s", 'uploaded/nearby', $attachment->name);

            $this->images->make($file, $attachment->path);
            $this->images->thumbnail($file, $attachment->thumbnail_path);

            $attachment->save();
        }

        flash()->success('Created!', 'Place has been created.');

        return redirect()->route('cms.places.edit', $placeId);
    }

    public function update(Request $request, $placeId, $id) 
    {
        $place = Place::find($placeId);
        
        $nearby =  $place->nearby()->findOrFail($id);
        $nearby->update($this->transformer->transform($request->all()));
        
        $attachment = $nearby->photos()->firstOrCreate([])
                        ->fill([
                            'th' => ['title' => $nearby->translate('th')->title],
                            'en' => ['title' => $nearby->translate('en')->title],
                            'thumbnail' => true
                        ]);

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

            $attachment->path = sprintf("%s/%s", 'uploaded/nearby', $attachment->name);
            $attachment->thumbnail_path = sprintf("%s/tn-%s", 'uploaded/nearby', $attachment->name);

            $this->images->make($file, $attachment->path);
            $this->images->thumbnail($file, $attachment->thumbnail_path);

            \File::delete([
                $attachment->getOriginal('path'),
                $attachment->getOriginal('thumbnail_path') 
            ]);

            $attachment->save();
        }

        flash()->success('Update!', 'Place has been updated.');

        return redirect()->route('cms.places.edit', $placeId);
    }

    public function destroy(Request $request, $placeId, $id) 
    {
        $nearby = Place::findOrFail($placeId)->nearby()->findOrFail($id);
        $nearby->delete();

        flash()->success('Deleted!', "Successfully deleted.");

        return redirect()->route('cms.places.edit', $placeId);
    }
}
