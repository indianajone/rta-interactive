<?php

namespace Ravarin\Entities;

use Ravarin\Entities\Attachment;
use Ravarin\Translations\TranslateMapable;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Translatable;

    /**
     * Determine translatable fields.
     *
     * @var array
     */
    public $translatedAttributes = ['title', 'excerpt', 'body'];

    /**
     * Define translation model.
     *
     * @var string
     */
    protected $translationModel = PostTranslations::class;

    /**
     * Define translation relationship foreign key.
     *
     * @var string
     */
    protected $translationForeignKey = 'post_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'type'];

    /**
     * Get all of the Post's attachments.
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

}
