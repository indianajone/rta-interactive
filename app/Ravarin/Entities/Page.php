<?php

namespace Ravarin\Entities;

class Page extends Post
{
    protected $table = 'posts';

    public function slides() 
    {
        return $this->attachments()->where('type', 'slide');
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

        if ($this->isTranslationAttribute($key)) {
            if ($this->hasTranslation($locale)) {
                return $this->translate($locale)->{$key};
            }
        }

        return parent::getAttribute($key);
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

        return $this->isTranslationAttribute($key) || parent::__isset($key);
    }

    /**
     * Get mapable attibutes form the model.
     *
     * @return [type]
     */
    public function getMapableAttributes() 
    {
        return isset($this->attributeMapper) ? $this->attributeMapper : [];
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