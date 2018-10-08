<?php

namespace Profile\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ProfileMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (user() && user()->handlename == $request->handle) {
            return $next($request);
        }

        if (user() && (int) user()->id === (int) $request->profile) {
            return $next($request);
        }

        return abort(404);
    }
}
