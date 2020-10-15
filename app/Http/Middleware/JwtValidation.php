<?php

namespace App\Http\Middleware;

use App\Helpers\EncodeHelper;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class JwtValidation
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

        $secret = getenv('SECRET');

        //split and decode the jwt
        $tokenParts = explode('.', $jwt);
        $header = base64_decode($tokenParts[0]);
        $payload = base64_decode($tokenParts[1]);
        $givenSignatur = $tokenParts[2];

        //get expiration time out of payload
        $expiration = Carbon::createFromTimestamp(json_decode($payload)->exp);
        $tokenExpired = (Carbon::now()->diffInSeconds($expiration, false) > 0);

        //rebuild a signatur based on header and payload
        $base64UrlHeader = (new EncodeHelper)->base64UrlEncode($header);
        $base64UrlPayload = (new EncodeHelper)->base64UrlEncode($payload);
        $signatur = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);
        $base64UrlSignatur = (new EncodeHelper)->base64UrlEncode($signatur);

        //check if signatur is valid
        $isSignaturValid = (!$base64UrlSignatur === $givenSignatur);

        if ($isSignaturValid) {
            return response()->json([
                'failed' => 'Signatur is invalid',
            ]);
        }
        return $next($request);

    }

}
