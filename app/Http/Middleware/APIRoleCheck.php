<?php

namespace App\Http\Middleware;

use App\Models\MyToken;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class APIRoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $token = $this->getTokenFromRequest($request);
        $user = $this->getUserFromToken($token);
        if ($user->hasRole('admin') || $user->hasRole($role)) {
            return $next($request);
        }
    }

    public function getTokenFromRequest(Request $request)
    {
        $token = $request->query('token');
        if (empty($token)) {
            $token = $request->input('token');
        }
        if (empty($token)) {
            $token = $request->bearerToken();
        }
        return $token;
    }

    public function getUserFromToken($token)
    {
        $token = MyToken::findToken($token);
        return $token->tokenable;
    }
}
