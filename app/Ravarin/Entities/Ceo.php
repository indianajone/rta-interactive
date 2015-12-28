<?php

namespace Ravarin\Entities;

use Ravarin\Entities\Page;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Ceo extends Page
{
    // use MapableAttribute;

    public $table = 'posts';

    protected $morphClass = Post::class;

    protected $attributeMapper = [
        'fullname' => 'title',
        'position' => 'excerpt',
        'description' => 'body'
    ];

    // public function update(array $attributes = []) {
    //     // $attributes = $this->transformDataFromRequest($attributes);
    //     // $this->fill($attributes);
    //     dd($attributes);
    //     // return $this->fill($attributes)->save();
    // }

    protected function transformDataFromRequest(array $request = []) 
    {
        $data = [];
        
        foreach ($request as $key => $value) {
            if ($this->isTanslatableFields($key)) {
                list($lang, $attribute) = explode('_', $key);
                $data[$lang][$this->getMapableAttribute($attribute)] = $value;
            }
            else {
                $data[$key] = $value;
            }
        }

        return $data;
    }

    public function updateImage(UploadedFile $file=null) 
    {
        if ($file) {
            $name = $file->getClientOriginalName();
            $baseDir = 'uploaded/components';
            $attachment = $this->image->fill([
                'name' => $name,
                'extension' => $file->getClientOriginalExtension(),
                'path' => sprintf('%s/%s',$baseDir, $name)
            ]);

            $file->move($baseDir, $name);

            $this->image()->save($attachment);
        }
    }

    public function image() 
    {
        return $this->attachments->where('type', 'image');
    }

    public function getImageAttribute() 
    {
        return $this->image()->first();
    }
}
