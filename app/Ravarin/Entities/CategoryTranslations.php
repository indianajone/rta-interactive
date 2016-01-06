<?php

namespace Ravarin\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslations extends Model
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
    protected $fillable = ['name'];

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }
}
