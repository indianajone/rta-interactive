<?php 

namespace Ravarin\Services;

use File;
use Image;
use Ravarin\Contracts\ImageManagerContract;

class InterventionImageManager implements ImageManagerContract
{
    public function make($src, $destination) 
    {
        Image::make($src)->save($destination);
    }

    public function thumbnail($src, $destination) 
    {
        Image::make($src)->fit(800, 600)->save($destination);
    }
}