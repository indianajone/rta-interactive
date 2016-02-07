<?php

namespace Ravarin\Entities;

use Illuminate\Support\Facades\File;
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

    /**
     * Determine if an attribute exists on the model.
     *
     * @param  string  $key
     * @return bool
     */
    public function __isset($key) 
    {
        $key = $this->getMapableAttribute($key);

        // Bug: when using translatable
        if ($key == 'useTranslationFallback') {
            return config('translatable.use_fallback');
        }

        return $this->isTranslationAttribute($key) || true;
    }

    public function delete() 
    {
        File::delete([
            $this->path, $this->thumbnail_path
        ]);

        return parent::delete();
    }
}
