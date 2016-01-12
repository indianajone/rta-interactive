<?php

namespace Ravarin\Entities;

use Illuminate\Database\Eloquent\Model;

class PlaceTranslations extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'excerpt', 'description',
        'street', 'subdistrict', 'district', 'province', 'postcode'
    ];

    public function place() 
    {
        return $this->belongsTo(Place::class);
    }
}
