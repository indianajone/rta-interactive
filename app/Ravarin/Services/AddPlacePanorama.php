<?php 

namespace Ravarin\Services;

use Ravarin\Entities\Place;
use App\Ravarin\Entities\Panorama;
use Ravarin\Services\InterventionImageManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Ravarin\Contracts\ImageManagerContract as ImageManager;

class AddPlacePanorama extends AddPlacePhoto
{
    public function make(UploadedFile $file=null) 
    {
        if ($file) {       
            $photo = $this->place->addPanorama($this->createPanorama($file));
            
            $file->move($photo->baseDir(), $photo->name);
            
            $this->image->thumbnail($photo->path, $photo->thumbnail_path);
        }
    }

    protected function createPanorama(UploadedFile $file) 
    {
        return new Panorama(['name' => $this->generateName($file)]);
    }
}