<?php

namespace Ravarin\Entities;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Attachment extends Model
{
    use Translatable;

    /**
     * Determine translatable fields.
     *
     * @var array
     */
    public $translatedAttributes = ['title', 'description'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'extension', 'path', 'width', 'height', 'type'];

    /**
     * Get all of the owning attachable models.
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function attachable()
    {
        return $this->morphTo();
    }
}
