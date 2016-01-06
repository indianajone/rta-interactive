<?php 

namespace Ravarin\Translations;

trait TranslateMapable 
{
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
     * Determine if the given attribute may be mass assigned.
     *
     * @param  string  $key
     * @return bool
     */
    public function isFillable($key) 
    {
        if (in_array($key, $this->translatedAttributes)) {
            return true;
        }

        return parent::isFillable($key);
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

    /**
     * Parser key to array
     *
     * @param  string $key
     * @return array
     */
    public function parseKeyAndLocale($key) 
    {
        if (str_contains($key, ':')) {
            list($key, $locale) = explode(':', $key);
        } else {
            $locale = $this->locale();
        }

        return [$key, $locale];
    }
}