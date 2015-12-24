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

    protected $attributeMapper = [
        'name' => 'title',
        'position' => 'excerpt',
        'description' => 'body'
    ];

    public function __construct(Post $post) 
    {
        $this->model = $post->where('name', 'ceo') ->first();
    }

    public function name($lang) 
    {
        $translate = $this->model->translate($lang);

        return $translate ? $translate->title : null;
    }

    public function position($lang) 
    {
        $translate = $this->model->translate($lang);

        return $translate ? $translate->excerpt : null;
    }

    public function description($lang) 
    {
        $translate = $this->model->translate($lang);

        return $translate ? $translate->body : null;
    }

    public function image() 
    {
        return $this->model->attachments()
                    ->where('type', 'image')
                    ->first();
    }

    public function update($data) 
    {
        foreach ($data as $lang => $attributes) {
            foreach($attributes as $key => $value) {
                $attribute = $this->getAttributes($key);
                $this->model->translateOrNew($lang)->{$attribute} = $value;
            }
        }

        $this->model->save();
    }

    private function getAttributes($key) {
        if (!isset($this->attributeMapper[$key])) {
            throw new LogicException("Undefined map key.");
        } 

        return $this->attributeMapper[$key];
    }

    public function __get($key) 
    {
        $lang = '';

        if (str_contains($key, '_')) {
            list($lang, $key) = explode('_', $key);
        }

        if (!method_exists($this, $key)) {
            throw new LogicException("Property key: {$key} does not exists in Ceo");
        }
      
        return call_user_func_array([$this, $key], [$lang]);
    }

    /**
     * Determine if an attribute exists on the model.
     *
     * @param  string  $key
     * @return bool
     */
    public function __isset($key)
    {
        if (str_contains($key, '_')) {
            $key = explode('_', $key)[1];
        }

        return method_exists($this, $key);
    }

}
