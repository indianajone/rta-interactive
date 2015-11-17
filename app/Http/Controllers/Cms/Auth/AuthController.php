<?php

namespace App\Http\Controllers\Cms\Auth;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function index() 
    {
        return view('cms.auth.login');
    }
}
