<?php

namespace App\Ravarin\Entities;

use Ravarin\Entities\Place;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function place() 
    {
        return $this->belongsTo(Place::class);
    }
}
