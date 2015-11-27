<?php 

namespace Ravarin\Services;

use Ravarin\Entities\Place;
use App\Ravarin\Entities\Photo;
use Ravarin\Services\InterventionImageManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Ravarin\Contracts\ImageManagerContract as ImageManager;

class AddPlacePhoto
{
    protected $place;

    protected $image;

    public function __construct(Place $place, ImageManager $image=null) 
    {
        $this->place = $place;
        
        $this->image = $image ?: new InterventionImageManager;
    }

    public function make(UploadedFile $file=null) 
    {
        if ($file) {       
            $photo = $this->place->addPhoto($this->createPhoto($file));
            
            $file->move($photo->baseDir(), $photo->name);
            
            $this->image->thumbnail($photo->path, $photo->thumbnail_path);
        }
    }

    protected function createPhoto(UploadedFile $file) 
    {
        return new Photo(['name' => $this->generateName($file)]);
    }

    protected function generateName(UploadedFile $file)
    {
        $name = sha1(time() . '-' . $file->getClientOriginalName());
        $extension = $file->getClientOriginalExtension();

        return "{$name}.{$extension}";
    }
}