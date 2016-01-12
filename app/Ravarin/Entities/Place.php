<?php

namespace Ravarin\Entities;

use Illuminate\Support\Str;
use App\Ravarin\Entities\Photo;
use App\Ravarin\Entities\Panorama;
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

        static::saving(function($place) {
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
        return (new static)->whereTranslation('title', str_replace('-', ' ', $slug))->firstOrFail();
    }

    public function scopeSearch($query, $keyword) 
    {
        return $query->where('name', 'LIKE', "%{$keyword}%");
    }

    public function scopeRecommended($query) 
    {
        return $query->where('recommended', true);
    }

    public function banners() 
    {
        return $this->photos->map(function ($item) {
            return [
                'title' => (string) $this->name,
                'src' => asset($item->path)
            ];
        });
    }

    public function slideshow() 
    {
        return $this->photos->map(function ($item) {
            return [
                'title' => $this->name,
                'src' => asset($item->thumbnail_path)
            ];
        });
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

    public function panorama() 
    {
        return $this->hasOne(Panorama::class);
    }

    /**
     * Add photo for place and save it.
     *
     * @param App\Ravarin\Entities\Panorama $photo
     * @return App\Ravarin\Entities\Photo|boolean
     */
    public function addPanorama(Panorama $photo) 
    {
        if ($this->panorama) 
        {
            // remeber to delete real file to save up spaces.
            $this->panorama()->delete();
        }

        return $this->panorama()->save($photo);
    }

    /**
     * Define relationship between photos and place
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos() 
    {
        return $this->hasMany(Photo::class);
    }

    /**
     * Add photo for place and save it.
     *
     * @param App\Ravarin\Entities\Photo $photo
     * @return App\Ravarin\Entities\Photo|boolean
     */
    public function addPhoto(Photo $photo) 
    {
        return $this->photos()->save($photo);
    }

    /**
     * Define relationship between video and place
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function video() 
    {
        return $this->hasOne(Video::class);
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
     * Get thunbnail or return the default one.
     *
     * @param  null|string $value
     * @return string
     */
    public function getThumbnailAttribute($value) 
    {
        $thumbnail = $this->photos()->where('thumbnail', true)->first();

        return $thumbnail ? $thumbnail->thumbnail_path : asset('/images/default.jpg');
    }
}
