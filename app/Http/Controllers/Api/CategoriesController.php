<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use Ravarin\Entities\Category;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index() 
    {
        return Category::getRootsLevelWithChildren();
    }
}
