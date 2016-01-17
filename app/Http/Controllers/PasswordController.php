<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use Ravarin\Entities\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class PasswordController extends Controller
{
    public function index(Request $request, $token) 
    {
        $email = $request->email;

        return view('pages.reset', compact('token', 'email'));
    }

    public function store(Request $request) 
    {
        $this->validate($request, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = Password::reset($credentials, function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();
            Auth::login($user);
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                return redirect()->home();

            default:
                return redirect()->back()
                            ->withInput($request->only('email'))
                            ->withErrors(['email' => trans($response)]);
        }
    }
}