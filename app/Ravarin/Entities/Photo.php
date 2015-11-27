<?php

namespace App\Ravarin\Entities;

use Ravarin\Entities\Place;
use Intervention\Image\ImageManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model
{
    protected $fillable = ['name', 'path', 'thumbnail_path'];

    public function place() 
    {
        return $this->belongsTo(Place::class);
    }

    public function baseDir() 
    {
        return 'uploaded/places';
    }

    public function setNameAttribute($name) 
    {
        $this->attributes['name'] = $name;
        $this->path = sprintf("%s/%s", $this->baseDir(), $this->name);
        $this->thumbnail_path = sprintf("%s/tn-%s", $this->baseDir(), $this->name);
    }
}
