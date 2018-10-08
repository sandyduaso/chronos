<?php

namespace Pluma\Support\Installation\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class CheckIfInstalled
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
        try {
            // First, check if can connect to database
            DB::connection()->getPdo();

            // Then, check if .install is deleted
            if (file_exists(storage_path('.install'))) {
                return redirect()->route('installation.welcome');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('installation.welcome');
        } catch (\PDOException $e) {
            return redirect()->route('installation.welcome');
        }

        return $next($request);
        // NOTUSED not used
    }
}
