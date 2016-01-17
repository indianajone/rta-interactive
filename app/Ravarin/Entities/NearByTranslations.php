<?php

namespace Ravarin\Entities;

use Illuminate\Database\Eloquent\Model;

class NearbyTranslations extends Model
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
    protected $fillable = ['title', 'description'];

    public function place() 
    {
        return $this->belongsTo(Place::class);
    }
}
