<?php

namespace App\Http\Middleware;

use App\Models\MyToken;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class MyTokenCheck
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
        $token = $request->query('token');
        if (empty($token)) {
            $token = $request->input('token');
        }
        if (empty($token)) {
            $token = $request->bearerToken();
        }

        if (MyToken::where('token', hash('sha256',$token))->exists()) {
            return $next($request);
        } else {
            abort(404);
        }

    }
}
