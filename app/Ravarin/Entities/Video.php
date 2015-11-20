<?php

namespace Ravarin\Entities;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function place() 
    {
        return $this->belongsTo(Place::class);
    }

    public function getThumbnailAttribute($value) 
    {
        return $value ?: '/images/default.jpg';
    }
}
