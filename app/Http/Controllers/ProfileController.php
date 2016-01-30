<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{

    public function __construct() 
    {
        $this->middleware('auth');    
    }
    
    public function index()
    {
        $user = Auth::user();

        return view('pages.profile', compact('user'));
    }
}
