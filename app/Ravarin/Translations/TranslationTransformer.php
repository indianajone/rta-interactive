<?php 

namespace Ravarin\Translations;

class TranslationTransformer 
{
    public function transform(array $request) 
    {
        $data = [];

        foreach ($request as $key => $value) {

            list($key, $locale) = $this->parseKeyAndLocale($key);
            
            if ($locale) {
                $data[$locale][$key] = $value;
            }
            else {
                $data[$key] = $value;
            }
        }

        return $data;
    }

    protected function parseKeyAndLocale($key) 
    {
        if (str_contains($key, ':')) {
            list($key, $locale) = explode(':', $key);
        } else {
            $locale = null;
        }

        return [$key, $locale];
    }
}
