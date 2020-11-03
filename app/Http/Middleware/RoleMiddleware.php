<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $permission = null)
    {
        $jwt = $request->bearerToken();

        //split and decode the jwt
        $tokenParts = explode('.', $jwt);
        $header = base64_decode($tokenParts[0]);
        $payload = base64_decode($tokenParts[1]);
        $givenSignatur = $tokenParts[2];

        $userRoles = json_decode($payload)->roles->data;

        foreach ($userRoles as $roles) {
            if ($role === $roles->slug || $roles->slug === 'admin') {
                return $next($request);
            }
        }

        return response()->json([
            'failed' => 'You dont have the permission',
        ]);
    }
}
