<?php

namespace App\Http\Controllers\Api;

use Socialite;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Available providers.
     * @var array
     */
    protected $providers = ['facebook', 'google'];

    public function store(Request $request, $provider=null) 
    {
        if ($provider && in_array($provider, $this->providers)) {
           return Socialite::driver($provider)->redirect();
        }

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!\Auth::attempt($request->all())) {
            return response()->json([
                'message' => 'invalid creadentials.'
            ], 403);
        }

        return response()->json([
            'code' => 200
        ]);
    }

    public function destroy() 
    {   
        \Auth::logout();
        
        return response()->json(['code' => 200], 200);
    }
}
