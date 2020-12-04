<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class RegisterAPIController extends Controller
{
    public function register(Request $request)
    {

        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        try {
            User::create(['name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->pasword)])->sendEmailVerificationNotification();
        } catch (Exception $e) {
            return response()->json([
                'error' => 'can u see this?'
            ], $e->getCode());
        }


        return response()->json([
            'success' => 'User created',
//            'newUser' => new UserResource($user),
        ]);
    }
}
