<?php

namespace Ravarin\Entities;

class Page extends Post
{
    protected $table = 'posts';

    public function slides() 
    {
        return $this->attachments()->where('type', 'slide');
    }
}