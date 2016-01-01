<?php

namespace Ravarin\Entities;

use Ravarin\Entities\Page;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Ceo extends Page
{
    public $table = 'posts';

    protected $morphClass = Post::class;

    protected $attributeMapper = [
        'fullname' => 'title',
        'position' => 'excerpt',
        'description' => 'body'
    ];

    protected function transformDataFromRequest(array $request = []) 
    {
        $data = [];
        
        foreach ($request as $key => $value) {

            list($key, $locale) = $this->parseKeyAndLocale($key);

            $key = $this->getMapableAttribute($key);
            
            if ($this->isTranslationAttribute($key)) {
                $data[$locale][$key] = $value;
            }
            else {
                $data[$key] = $value;
            }
        }

        return $data;
    }

    public function isFillable($key) 
    {
        if (in_array($key, $this->translatedAttributes)) {
            return true;
        }

        return parent::isFillable($key);
    }

    public function update(array $attributes = []) 
    {
        return parent::update($this->transformDataFromRequest($attributes));
    }

    public function updateImage(UploadedFile $file=null) 
    {
        if ($file) {
            $extension = $file->getClientOriginalExtension();
            $name = sha1(time() . '-' . $file->getClientOriginalName()) . '.' . $extension;
            $baseDir = 'uploaded/components';
            $attachment = $this->image->fill([
                'name' => $name,
                'extension' => $extension,
                'path' => sprintf('%s/%s',$baseDir, $name)
            ]);

            $file->move($baseDir, $name);

            $this->attachments()->where('type', 'image')->save($attachment);
        }
    }

    public function getImageAttribute() 
    {
        return $this->attachments->where('type', 'image')->first();
    }

    /**
     * Get an attribute from the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function getAttribute($key) 
    {
        list($key, $locale) = $this->parseKeyAndLocale($key);
        $key = $this->getMapableAttribute($key);

        return parent::getAttribute("$key:$locale" );
    }

    protected function parseKeyAndLocale($key) 
    {
        if (str_contains($key, ':')) {
            list($key, $locale) = explode(':', $key);
        } else {
            $locale = $this->locale();
        }

        return [$key, $locale];
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

        return parent::__isset($key);
    }

     /**
     * Get an real attribute from the mapable model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function getMapableAttribute($key) 
    {
        list($key, $locale) = $this->parseKeyAndLocale($key);
        return isset($this->attributeMapper[$key]) ? $this->attributeMapper[$key] : $key;
    }
}
