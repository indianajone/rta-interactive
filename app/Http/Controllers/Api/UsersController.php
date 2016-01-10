<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use Ravarin\Entities\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function store(Request $request, User $users) 
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $user = $this->users->create($request()->all());

        Auth::login($user);

        return response()->json([
            'code' => 200
        ]);
    }
}
