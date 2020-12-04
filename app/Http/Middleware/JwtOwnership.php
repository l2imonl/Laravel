<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JwtOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $jwt = $request->bearerToken();

        if (!$jwt) {
            return response()->json([
                'failed' => 'no bearerToken',
            ]);
        }

        //split and decode the jwt
        $tokenParts = explode('.', $jwt);
//        $header = base64_decode($tokenParts[0]);
        $payload = base64_decode($tokenParts[1]);
//        $givenSignatur = $tokenParts[2];

        $userID = json_decode($payload)->user_id;
        $requestID = $request->route('id');

        if ($userID == $requestID) {
            return $next($request);
        }

        return response()->json([
            'failed' => 'You dont have the permission to do that',
            'userID' => $userID,
            'requestID' => $requestID,
        ]);



    }
}
