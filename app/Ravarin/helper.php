<?php 

if (!function_exists('nav_route')) {
    function nav_route($route, $name) 
    {
        $link = '<a class="navbar-main__link'. 
                (Route::is($route) ? '--active"' : '"') . 
                ' href="' . route($route) . '">' . 
                '<span>' . $name . '</span></a>';

        return $link;
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