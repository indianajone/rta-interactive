<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Mail\Message;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class PasswordsController extends Controller
{
    public function __construct() 
    {
        $this->middleware('guest');
    }

    public function store(Request $request) 
    {
        $this->validate($request, ['email' => 'required|email']);

        $response = Password::sendResetLink($request->only('email'), function (Message $message) {
            $message->subject('Your Password Reset Link');
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return response()->json(['status' => trans($response)]);

            case Password::INVALID_USER:
            default:
                return response()->json(['email' => trans($response)], 404);
        }
    }
}
