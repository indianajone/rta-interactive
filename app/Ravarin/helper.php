<?php 

if (!function_exists('slugify')) {
    function slugify($title, $separator=null) 
    {
        $separator =  $separator ?: '-';

        $title = preg_replace('~[^\\pL\d้ำัไใาะี๊ๆฯ็้๋่ิ์ุูึๅ]+~u', $separator, $title);
        $title = trim($title, '-');
        $title = iconv('utf-8', 'utf-8', $title);
        
        return trim(strtolower($title));
    }
}

if (!function_exists('lang_route')) {
    function lang_route($locale) {
        $request = request()->instance();
        $root = $request->root();
        $path = preg_replace('/(?:en|th)\b\/?/', '', $request->path());
        
        return "{$root}/{$locale}/{$path}";
    }
}

if (!function_exists('nav_route')) {
    function nav_route($route, $name) 
    {
        $link = '<a class="navbar-main__link'. 
                (Route::is($route) ? ' navbar-main__link--active"' : '"') . 
                ' href="' . route($route, ['lang' => session()->get('locale')]) . '">' . 
                '<span>' . trans('menu.'.$name) . '</span></a>';

        return $link;
    }
}

if (!function_exists('place_path')) {
    function place_path($place) 
    {
        return route('place_path', [ 
            'lang' => session()->get('locale'),
            'slug' => str_replace(' ', '-', $place->name)
        ]);
    }
}

if (!function_exists('map_path')) {
    function map_path($place) 
    {
        return route('map_path', [ 
            'lang' => session()->get('locale'),
            'slug' => str_replace(' ', '-', $place->name)
        ]);
    }
}

if (!function_exists('page_class')) {
    function page_class() 
    {
        return str_replace('_path', '', Route::currentRouteName());
    }
}

if (!function_exists('flash')) {
    function flash($title=null, $message=null)
    {
        $flash = app('Ravarin\Http\Flash');

        if (func_num_args() == 0) {
            return $flash;
        }

        $flash->message($title, $message);
    }
}