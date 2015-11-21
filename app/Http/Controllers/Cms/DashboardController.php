<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Requests;
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
        return view('cms.dashboard.index');
    }
}
