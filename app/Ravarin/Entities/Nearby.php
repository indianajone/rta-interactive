<?php

namespace Ravarin\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Ravarin\Translations\TranslateMapable;

class Nearby extends Model
{
    use TranslateMapable, Translatable {
        TranslateMapable::__isset insteadof Translatable;
    }

    /**
     * Determine translatable fields.
     *
     * @var array
     */
    public $translatedAttributes = ['title','description'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tel', 'latitude', 'longitude'];

    /**
     * Define relationship between photos and nearby
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function photos() 
    {
        return $this->morphMany(Attachment::class, 'attachable')
                    ->where('type', 'image');
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

     /**
     * Get thumbnail or return the default one.
     *
     * @param  null|string $value
     * @return string
     */
    public function getThumbnailAttribute($value) 
    {
        $thumbnail = $this->photos->where('thumbnail', 1)->first();

        return $thumbnail ? asset($thumbnail->thumbnail_path) : asset('/images/default.jpg');
    }

    public function delete()
    {
        $attachments = $this->photos()->get();

        $attachments->each(function ($attachment) {
            $attachment->delete();
        });

        return parent::delete();
    }
}
