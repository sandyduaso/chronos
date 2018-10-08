<?php

namespace Frontier\Support\Breadcrumbs\Middlewares;

use Closure;
use Illuminate\Support\Facades\Schema;

class Breadcrumbs
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $table
     * @return mixed
     */
    public function handle($request, Closure $next, $table = null)
    {
        if (class_exists($table)) {
            $tableName = with(new $table)->getTable();
            $id = $request->route(str_singular($tableName));
            $crumb = $table::find($id);
            if ($crumb) {
                $crumb = $crumb->crumb;
                // Store on the route request
                $request->route()->setParameter('breadcrumb', $crumb);
                // Also store somewhere else in case route requests are not available.
                config(['breadcrumb:leaf' => $crumb]);
            }
        }

        return $next($request);
    }
}
