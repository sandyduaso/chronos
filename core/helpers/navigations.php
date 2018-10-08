<?php

use Frontier\Composers\NavigationViewComposer;
use Frontier\Composers\SidebarComposer;
use Frontier\Support\Breadcrumbs\Composers\BreadcrumbComposer;
use Illuminate\Support\Facades\Request;
use Pluma\Support\Facades\Route;

if (! function_exists('navigations')) {
    /**
     * Gets all the navigations.
     *
     * @param  string   $key
     * @param  boolean  $collected
     * @return mixed
     */
    function navigations($key = null, $collected = true)
    {
        // if (cache()->has("navigations.$key")) {
        //     return cache()->get("navigations.$key", []);
        // }

        $composer = new NavigationViewComposer();
        $composer->setCurrentUrl(Request::path());
        $composer->setCurrentRouteName(Route::currentRouteName());
        $composer->setMenus($composer->getFileFromModules('config/menus.php'));
        $composer->setBreadcrumbs($composer->getCurrentUrl());

        $composer = $collected
            ? ($composer->handle()->{$key}->collect ?? $composer->handle()->{$key})
            : $composer->handle()->{$key};

        return $composer;
    }
}

if (! function_exists('navigation')) {
    /**
     * Gets the current navigation based on route.
     *
     * @param  string $key
     * @return mixed
     */
    function navigation($key = "sidebar.current")
    {
        return config("app.navigations.{$key}");
    }
}

if (! function_exists('sidebar')) {
    /**
     * Retrieves the sidebar menus
     *
     * @param string $command
     * @return array
     */
    function sidebar($command = null)
    {
        $name = "cached::sidebar" . (! user() ?: user()->id);

        switch ($command) {
            case 'refresh':
                cache()->forget($name);
                break;

            default:
                //
                break;
        }

        return cache()->remember($name, 120, function () {
            $composer = new SidebarComposer();
            return $composer->handle();
        });
    }
}

if (! function_exists('breadcrumbs')) {
    /**
     * Retrieves the breadcrumbs menus
     *
     * @return mixed
     */
    function breadcrumbs()
    {
        $composer = new BreadcrumbComposer();
        $composer->setCurrentUrl(Request::path());
        $composer->setCurrentRouteName(Route::currentRouteName());
        $composer->setBreadcrumbs($composer->getCurrentUrl());
        return $composer->handle();
    }
}
