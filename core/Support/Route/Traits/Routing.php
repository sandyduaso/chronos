<?php

namespace Pluma\Support\Routes\Traits;

use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Pluma\Routing\Router;
use Pluma\Providers\InstallationServiceProvider;

trait Routing
{
    protected $request;
    protected $events;
    protected $router;

    public function routes()
    {
        $this->bindRouter();
        $this->createDispatcher();
        $this->createRouterInstance();
        $this->loadRoutes();
    }

    public function bindRouter()
    {
        $this->request = Request::capture();
        $this->app->instance(\Illuminate\Http\Request::class, $this->request);
    }

    public function loadRoutes()
    {
        if (is_installed()) {
            include_file(core_path("routes"), "routes.php");
        } else {
            $provider = new InstallationServiceProvider($this);
            $provider->boot();
            $provider->register();
        }
    }

    public function createDispatcher()
    {
        $this->events = new Dispatcher($this->app);
    }

    public function createRouterInstance()
    {
        $this->router = new Router($this->events, $this->app);
    }
}
