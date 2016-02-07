<?php

namespace Ravarin\Entities;

use Illuminate\Support\Facades\File;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Ravarin\Translations\TranslateMapable;

class Place extends Model
{
    use TranslateMapable, Translatable {
        TranslateMapable::__isset insteadof Translatable;
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($place) {
            $place->name = slugify($place->title);
        });
    }

    /**
     * Determine translatable fields.
     *
     * @var array
     */
    public $translatedAttributes = [
        'title', 'excerpt', 'description',
        'street', 'subdistrict', 'district', 'province', 'postcode'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'recommended', 'latitude', 'longitude'];

    /**
     * Get place by its name
     *
     * @param  string $slug
     * @return this
     */
    public static function findBySlug($slug)
    {
        return (new static)->where('name', $slug)
                ->with('photos', 'nearby')
                ->firstOrFail();
    }

    public function scopeSearch($query, $keyword)
    {
        if (!$keyword) {
            return $query;
        }

        return $query->whereHas('translations', function ($q) use ($keyword) {
            return $q->where('title', 'LIKE', "%{$keyword}%");
        });
    }

    public function scopeRecommended($query)
    {
        return $query->where('recommended', true);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    /**
     * Define relationship between categories and place
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    /**
     * Define relationship between photos and place
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function photos()
    {
        return $this->attachments()->where('type', 'image');
    }

    /**
     * Define relationship between video and place
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function videos()
    {
        return $this->attachments()->where('type', 'video');
    }

    /**
     * Define relationship between panorana and place
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function panoramas()
    {
        return $this->attachments()->where('type', 'panorama');
    }

    /**
     * Define relationship between panorana and place
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function markers()
    {
        return $this->attachments()->where('type', 'marker');
    }

    /**
     * Define relationship between nearby and place
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nearby()
    {
        return $this->hasMany(Nearby::class);
    }

    public function favoriteUsers()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    public function hasFavoritedByUser($user)
    {
        if (!$user) {
            return false;
        }

        return (boolean) $user->hasFavoritePlace($this);
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
     * Get excerpt or grap description and shorten it.
     *
     * @param  string $value
     * @return string
     */
    public function getExcerptAttribute($value)
    {
        return $value ?: str_limit($this->description);
    }

    /**
     * Get latitude and longitude.
     *
     * @return string
     */
    public function getLatLngAttribute()
    {
        return json_encode([
            'title' => $this->title,
            'icon' => asset('images/place-pin.png'),
            'geometry' => [
                'location' => [
                    'lat' => $this->latitude,
                    'lng' => $this->longitude
                ]
            ]
        ]);
    }

    /**
     * Get full address.
     *
     * @return string
     */
    public function getAddressAttribute()
    {
        return implode(' ', [
            $this->street,
            $this->subdistrict,
            $this->district,
            $this->province,
            $this->postcode
        ]);
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

    public function getViewsAttribute()
    {
        $text = trans('common.views');
        $views = $this->view;

        if (app()->getLocale() == 'th') {
            return trans('common.views', compact('views'));
        }

        return $views . ' ' . str_plural(trans('common.views'), $views);
    }

    public function delete()
    {
        $attachments = $this->attachments()->get();

        $attachments->each(function ($attachment) {
            $attachment->delete();
        });

        return parent::delete();
    }
}
