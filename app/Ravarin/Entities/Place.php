<?php

namespace Ravarin\Entities;

use App\Ravarin\Entities\Photo;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'name', 'excerpt', 'description', 'street', 'subdistrict',
        'district', 'province', 'postcode', 'latitude', 'longitude'
    ];

    public function photos() 
    {
        return $this->hasMany(Photo::class);
    }

    public function getThumbnailAttribute() 
    {
        return $this->photos()->first();
    }
}
