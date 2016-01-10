<?php

namespace App\Http\Controllers;

use Auth;
use Socialite;
use App\Http\Requests;
use Ravarin\Entities\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function index($provider, User $users) 
    {
        $socialite = Socialite::driver($provider)->user();

        $user = $users->createOrUpdateFromSocialite($socialite);

        Auth::login($user);

        return redirect('/');
    }
}
