<?php

namespace Pluma\Support\Facades;

use Illuminate\Support\Facades\Facade;

class Route extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @see \Pluma\Routing\Router
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'router';
    }
}
