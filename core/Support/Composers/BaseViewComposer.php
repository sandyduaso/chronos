<?php

namespace Pluma\Support\Composers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use User\Models\User;

class BaseViewComposer
{
    /**
     * The page's current url.
     *
     * @var string
     */
    protected $currentUrl;

    /**
     * The current route instance.
     *
     * @var string
     */
    protected $currentRouteName;

    /**
     * The view's variable.
     *
     * @var string
     */
    protected $name;

    /**
     * The currently logged in user.
     *
     * @var \User\Models\User
     */
    protected $user;

    /**
     * Initialize the base composer class.
     *
     */
    public function __construct()
    {
        $this->setCurrentUrl(Request::path());

        $this->setCurrentRouteName(Route::currentRouteName());

        $this->setName($this->name);

        $this->user = user();
    }

    /**
     * Main function to tie everything together.
     *
     * @param  Illuminate\View\View   $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with($this->name(), $this->handle());
    }

    /**
     * Sets the current url.
     *
     * @param string $urlPath
     */
    public function setCurrentUrl($urlPath)
    {
        $this->currentUrl = rtrim($urlPath, '/');
    }

    /**
     * Gets the current url value.
     *
     * @return string
     */
    public function getCurrentUrl()
    {
        return $this->currentUrl ?? Route::current()->uri();
    }

    /**
     * Sets the current route.
     *
     * @param string $currentRouteName
     */

    public function setCurrentRouteName($currentRouteName)
    {
        $this->currentRouteName = $currentRouteName;
    }

    /**
     * Gets the current route value.
     *
     * @return string
     */
    public function getCurrentRouteName()
    {
        return $this->currentRouteName;
    }

    /**
     * Check if route exists.
     *
     * @param  string  $url
     * @return boolean
     */
    public function hasRouteNameFromUrl($url)
    {
        return (bool) $this->getRouteNameFromUrl($url);
    }

    /**
     * Try to guess the route name of the given url.
     *
     * @return string
     */
    public function getRouteNameFromUrl($url)
    {
        return app('router')
                ->getRoutes()
                ->match(
                    app('request')->create($url)
                )->getName();
    }

    /**
     * Sets the variable name.
     *
     * @param string $name
     */
    protected function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Gets the variable name value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Alias for getName
     *
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Swap words from config/swappables.php
     *
     * @param  string $segment
     * @return string
     */
    public function swapWord($segment)
    {
        foreach (config("swappables", []) as $name => $swap) {
            if (strtolower($name) === strtolower($segment)) {
                return $swap;
            }
        }

        return $segment;
    }

    /**
     * Get all the modules.
     *
     * @return array
     */
    public function modules()
    {
        return get_modules_path();
    }
}
