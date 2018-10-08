<?php

namespace Frontier\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectToDashboardIfAuthenticated
{
    /**
     * The redirect dashboard path when authenticated.
     *
     * @var string
     */
    protected $redirectPath = 'dashboard';

    /**
     * Handle an incoming request.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $this->redirectPath = route(config('path.dashboard', $this->redirectPath));

            return redirect()->intended($this->redirectPath);
        }

        return $next($request);
    }
}
