<?php

namespace App\Ravarin\Entities;

use Ravarin\Entities\Place;
use Illuminate\Database\Eloquent\Model;

class Panorama extends Model
{
    protected $fillable = ['name', 'path', 'thumbnail_path'];
    
    public function place() 
    {
        return $this->belongsTo(Place::class);
    }

    public function baseDir() 
    {
        return 'uploaded/panorama';
    }

    public function setNameAttribute($name) 
    {
        $this->attributes['name'] = $name;
        $this->path = sprintf("%s/%s", $this->baseDir(), $this->name);
        $this->thumbnail_path = sprintf("%s/tn-%s", $this->baseDir(), $this->name);
    }
}
