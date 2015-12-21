<?php

namespace Ravarin\Entities;

use LogicException;
use Ravarin\Entities\Post;

class Ceo
{
    /**
     * Ceo Model
     *
     * @var Ravarin\Entities\Post
     */
    protected $model;

    public function __construct(Post $post) 
    {
        $this->model = $post->where('name', 'ceo') ->first();
    }

    public function name() 
    {
        return $this->model->title;
    }

    public function position() 
    {
        return $this->model->excerpt;
    }

    public function description() 
    {
        return $this->model->body;
    }

    public function image() 
    {
        return $this->model->attachments()
                    ->where('type', 'image')
                    ->first();
    }

    public function __get($key) 
    {
        if (!method_exists($this, $key)) {
            throw new LogicException("Propery key: {$key} does not exists in Ceo");
        }

        return call_user_func_array([$this, $key], []);
    }
}
