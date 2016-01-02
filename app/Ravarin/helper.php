<?php 

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
                (Route::is($route) ? '--active"' : '"') . 
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