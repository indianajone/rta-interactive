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
}
