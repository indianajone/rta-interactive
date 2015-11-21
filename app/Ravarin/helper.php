<?php 

function link_to_route($route, $name) 
{
    $link = '<a class="navbar-main__link'. 
            (Route::is($route) ? '--active"' : '"') . 
            ' href="' . route($route) . '">' . 
            '<span>' . $name . '</span></a>';

    return $link;
}

function page_class() 
{
    return str_replace('_path', '', Route::currentRouteName());
}