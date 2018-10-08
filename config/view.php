<?php

return [

    /**
     *--------------------------------------------------------------------------
     * View Storage Paths
     *--------------------------------------------------------------------------
     *
     * Most templating systems load templates from disk. Here you may specify
     * an array of paths that should be checked for your views. Of course
     * the usual application view path has already been registered for you.
     *
     */

    'paths' => [
        realpath(resource_path('views')),
        realpath(core_path('theme/views'))
    ],

    /**
     *--------------------------------------------------------------------------
     * Compiled View Path
     *--------------------------------------------------------------------------
     *
     * This option determines where all the compiled Blade templates will be
     * stored for your application. Typically, this is within the storage
     * directory. However, as usual, you are free to change this value.
     *
     */

    'compiled' => realpath(storage_path('framework/views')),

    /**
     *--------------------------------------------------------------------------
     * Static View Path
     *--------------------------------------------------------------------------
     *
     * Static views are used as fallbacks if no view was found for a specific
     * request.
     * The static views can be access via the 'Static' hint path.
     * E.g. view('Static::index')
     */
    'static' => realpath(resource_path('views/static')),
];
