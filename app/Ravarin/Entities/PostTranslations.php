<?php

namespace Ravarin\Entities;

use Illuminate\Database\Eloquent\Model;

class PostTranslations extends Model
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
    protected $fillable = ['title', 'excerpt', 'body'];

    public function post() 
    {
        return $this->belongsTo(Post::class);
    }
}
