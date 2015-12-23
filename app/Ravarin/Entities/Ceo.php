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

    public function name_en() 
    {
        $trans = $this->model->translate('en');
        return $trans ? $trans->title : '';
    }

    public function position_en() 
    {
        $trans = $this->model->translate('en');
        return $trans ? $trans->excerpt : '';
    }

    public function description_en() 
    {
        $trans = $this->model->translate('en');
        return $trans ? $trans->body : '';
    }

    public function image() 
    {
        return $this->model->attachments()
                    ->where('type', 'image')
                    ->first();
    }

    public function model() 
    {
        return $this->model;
    }

    public function __get($key) 
    {
        if (!method_exists($this, $key)) {
            throw new LogicException("Propery key: {$key} does not exists in Ceo");
        }

        return call_user_func_array([$this, $key], []);
    }

    /**
     * Determine if an attribute exists on the model.
     *
     * @param  string  $key
     * @return bool
     */
    public function __isset($key)
    {
        return method_exists($this, $key);
    }

}
