<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MailVerifyAPIController extends Controller
{
    public function verify(Request $request,$signatur,$id){
        $user = User::find($request->id);

        $verification_key = getenv('EMAIL_VERIFICATION_KEY');

        if(hash_hmac('sha256',$id,$verification_key,false) === $signatur){
            if (!$user->hasVerifiedEmail()) {
                $user->markEmailAsVerified();
            }

            return response()->json([
                'success' => 'email is verified',
            ]);
        }
        return response()->json([
            'error' => 'something went wrong'
        ],404);

    }
}
