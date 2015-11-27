<?php

namespace Ravarin\Entities;

use Illuminate\Support\Str;
use App\Ravarin\Entities\Photo;
use App\Ravarin\Entities\Panorama;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'name', 'excerpt', 'description', 'street', 'subdistrict',
        'district', 'province', 'postcode', 'latitude', 'longitude'
    ];

    /**
     * Get place by its name
     *
     * @param  string $slug
     * @return this
     */
    public static function findBySlug($slug)
    {
        return (new static)->where('name', str_replace('-', ' ', $slug))->firstOrFail();
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
     * Get thunbnail or return the default one.
     *
     * @param  null|string $value
     * @return string
     */
    public function getThumbnailAttribute($value) 
    {
        $thumbnail = $this->photos()->first();

        return $thumbnail ? $thumbnail->thumbnail_path : asset('/images/default.jpg');
    }
}
