<?php

namespace Pluma\Routing;

use Illuminate\Routing\PendingResourceRegistration;
use Illuminate\Routing\Router as BaseRouter;
use Pluma\Routing\ResourceRegistrar;
use Pluma\Routing\SoftDeletesResourceRegistrar;

class Router extends BaseRouter
{
    /**
     * Route a resource to a controller.
     *
     * @param  string  $name
     * @param  string  $controller
     * @param  array  $options
     * @return \Illuminate\Routing\PendingResourceRegistration
     */
    public function resource($name, $controller, array $options = [])
    {
        if ($this->container && $this->container->bound(ResourceRegistrar::class)) {
            $registrar = $this->container->make(ResourceRegistrar::class);
        } else {
            $registrar = new ResourceRegistrar($this);
        }

        return new PendingResourceRegistration(
            $registrar, $name, $controller, $options
        );
    }

    /**
     * Register an array of soft delete resource controllers.
     *
     * @param  string  $name
     * @param  string  $controller
     * @param  array   $options
     * @return \Illuminate\Routing\PendingResourceRegistration
     */
    public function softDeletes($name, $controller, array $options = [])
    {
        if ($this->container && $this->container->bound(SoftDeletesResourceRegistrar::class)) {
            $registrar = $this->container->make(SoftDeletesResourceRegistrar::class);
        } else {
            $registrar = new SoftDeletesResourceRegistrar($this);
        }

        return new PendingResourceRegistration(
            $registrar, $name, $controller, $options
        );
    }

    /**
     * Set the unmapped global resource parameters to singular.
     *
     * @param  bool  $singular
     * @return void
     */
    public function singularResourceParameters($singular = true)
    {
        ResourceRegistrar::singularParameters($singular);
    }

    /**
     * Set the global resource parameter mapping.
     *
     * @param  array  $parameters
     * @return void
     */
    public function resourceParameters(array $parameters = [])
    {
        ResourceRegistrar::setParameters($parameters);
    }

    /**
     * Get or set the verbs used in the resource URIs.
     *
     * @param  array  $verbs
     * @return array|null
     */
    public function resourceVerbs(array $verbs = [])
    {
        return ResourceRegistrar::verbs($verbs);
    }
}
