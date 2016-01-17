<?php

namespace App\Http\Controllers\Cms;

use App\Http\Requests;
use Ravarin\Entities\Place;
use Illuminate\Http\Request;
use Ravarin\Entities\Attachment;
use App\Http\Controllers\Controller;
use Ravarin\Translations\TranslationTransformer;
use Ravarin\Services\InterventionImageManager as ImageManager;

class PlacesVideoController extends Controller
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

        $attachment = $place->videos()
                            ->create(
                                $this->transformer->transform($request->all())
                            );

        // Upload and create thumbnail
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            
            $attachment->name = sha1(time() . '-' . $file->getClientOriginalName()) . '.' . $extension;
            $attachment->extension = $extension;
            $attachment->type = 'video';
            
            $imageSize = @getimagesize($file->getPathname());
            
            if ($imageSize) {
                $attachment->width = $imageSize[0];
                $attachment->height = $imageSize[1];
            }

            $attachment->thumbnail_path = sprintf("%s/tn-%s", 'uploaded/videos', $attachment->name);

            $this->images->thumbnail($file, $attachment->thumbnail_path);

            $attachment->save();
        }

        flash()->success('Created!', 'Video has been created.');

        return redirect()->route('cms.places.edit', $placeId);
    }

    public function update(Request $request, $placeId, $id) 
    {
        $place = Place::find($placeId);
        
        $attachment =  $place->videos()->find($id);
        $attachment->update($this->transformer->transform($request->all()));

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            
            $attachment->name = sha1(time() . '-' . $file->getClientOriginalName()) . '.' . $extension;
            $attachment->extension = $extension;
            
            $attachment->thumbnail_path = sprintf("%s/tn-%s", 'uploaded/videos', $attachment->name);

            $this->images->thumbnail($file, $attachment->thumbnail_path);

            \File::delete([
                $attachment->getOriginal('thumbnail_path') 
            ]);

            $attachment->save();
        }

        flash()->success('Update!', 'Photo has been updated.');

        return redirect()->route('cms.places.edit', $placeId);
    }
}
