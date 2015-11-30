<?php

namespace Ravarin\Entities;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'parent_id'];

    public static function getRootsLevelWithChildren() 
    {
        return (new static)->root()
                ->with('children')
                ->get(['id', 'name', 'parent_id']);
    }

    public function totalPlaces() 
    {
        return $this->children()->with('places')->get()
                    ->lists('places')
                    ->collapse()->unique('id')
                    ->count();
    }

    public function listGroups() 
    {
        return $this->root()->get()->lists('name', 'id');
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
}
