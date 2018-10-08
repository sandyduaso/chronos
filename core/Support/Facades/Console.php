<?php

namespace Pluma\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Illuminate\Contracts\Console\Kernel
 */
class Console extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Illuminate\Contracts\Console\Kernel';
    }
}
