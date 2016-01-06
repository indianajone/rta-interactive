<?php

namespace Ravarin\Entities;

use Ravarin\Translations\TranslateMapable;

class Page extends Post
{
    use TranslateMapable;

    protected $table = 'posts';

    public function slides() 
    {
        return $this->attachments()->where('type', 'slide');
    }

    public function scopeAbout($query) 
    {
        return $query->with('translations')->where('name', 'about')->first();
    }
}