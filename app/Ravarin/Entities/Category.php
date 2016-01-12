<?php

namespace Ravarin\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Ravarin\Translations\TranslateMapable;

class Category extends Model
{
    use TranslateMapable, Translatable {
        TranslateMapable::__isset insteadof Translatable;
    }

    protected $fillable = ['parent_id'];

     /**
     * Determine translatable fields.
     *
     * @var array
     */
    public $translatedAttributes = ['name'];

    /**
     * Define translation model.
     *
     * @var string
     */
    protected $translationModel = CategoryTranslations::class;

    public static function getRootsLevelWithChildren() 
    {
        return (new static)->root()
                ->with('children', 'translations')
                ->get(['id', 'parent_id']);
    }

    public function totalPlaces() 
    {
        // dd($this->children()->with('places')->get());
        return $this->children()->with([
                        'places' => function ($query) {
                            return $query->select('id');
                        }])
                    ->get()
                    ->lists('places')
                    ->collapse()->unique('id')
                    ->count();
    }

    public function listGroups() 
    {
        $lists = [];
        $categories = $this->root()->get();

        foreach ($categories as $category) {
            $lists = array_add($lists, $category->id ,$category->name);
        }
        
        return $lists;
    }

    public function listGroupWithChildren() 
    {
        $groups = $this->getRootsLevelWithChildren();

        $collection = [];

        foreach ($groups as $group) {
            $groupName = $group->name;
            $collection[$groupName] = [];
            foreach ($group->children as $category) {
                $collection[$groupName][$category->id] = $category->name;
            }
        }

        return $collection;
    }

    public function scopeRoot($query) 
    {
        return $query->whereNull('parent_id');
    }

    public function setParentIdAttribute($value) 
    {
        $this->attributes['parent_id'] = empty($value) ? null : $value;
    }

    /**
     * Get all sub category.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children() 
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Get parent category.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent() 
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Get places accociate with category.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function places() 
    {
        return $this->belongsToMany(Place::class)->withTimestamps();
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
}
