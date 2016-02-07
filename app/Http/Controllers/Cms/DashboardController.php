<?php

namespace App\Http\Controllers\Cms;

use App\Http\Requests;
use Ravarin\Entities\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');

        parent::__construct();    
    }

    public function index() 
    {
        $count = Place::count();

        $mostView = Place::with('translations')->orderBy('view', 'desc')->first();

        return view('cms.dashboard.index', compact('count', 'mostView'));
    }
}
