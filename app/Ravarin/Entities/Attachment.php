<?php

namespace Ravarin\Entities;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;
use Ravarin\Translations\TranslateMapable;

class Attachment extends Model
{
    use TranslateMapable, Translatable {
        TranslateMapable::__isset insteadof Translatable;
    }

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
    protected $fillable = ['name', 'thumbnail', 'extension', 'path', 'width', 'height', 'type'];

    /**
     * Get all of the owning attachable models.
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function attachable()
    {
        return $this->morphTo();
    }

    public function trans($locale, $attribute) 
    {
        $trans = $this->translate($locale);

        return $trans ? $trans->{$attribute} : '';
    }
}
