<?php

namespace Ravarin\Entities;

use Illuminate\Support\Str;
use App\Ravarin\Entities\Photo;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'name', 'excerpt', 'description', 'street', 'subdistrict',
        'district', 'province', 'postcode', 'latitude', 'longitude'
    ];

    public static function findBySlug($slug)
    {
        return (new static)->where('name', str_replace('-', ' ', $slug))->firstOrFail();
    }

    public function photos() 
    {
        return $this->hasMany(Photo::class);
    }

    public function getThumbnailAttribute() 
    {
        $thumbnail = $this->photos()->first();

        return $thumbnail ? $thumbnail->thumbnail_path : 'images/default.jpg';
    }
}
