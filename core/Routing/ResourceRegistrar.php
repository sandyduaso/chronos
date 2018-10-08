<?php

namespace Pluma\Routing;

use Illuminate\Routing\ResourceRegistrar as BaseResourceRegistrar;
use Illuminate\Support\Str;

class ResourceRegistrar extends BaseResourceRegistrar
{
    /**
     * Get the action array for a resource route.
     *
     * @param  string  $resource
     * @param  string  $controller
     * @param  string  $method
     * @param  array   $options
     * @return array
     */
    protected function getResourceAction($resource, $controller, $method, $options)
    {
        $name = $this->getResourceRouteName($resource, $method, $options);

        $component = $this->getResourceComponent($name);

        $module = isset($options['module']) ? $options['module'] . '/' : '';

        $action = [
            'as' => $name,
            'uses' => $controller.'@'.$method,
            'module' => $options['module'] ?? '',
            'component' => $module.$component,
        ];

        if (isset($options['middleware'])) {
            $action['middleware'] = $options['middleware'];
        }

        return $action;
    }

    /**
     * Get the component for a resource route.
     *
     * @param string $name
     * @return string
     */
    protected function getResourceComponent($name)
    {
        $component = explode('.', $name);

        foreach ($component as $i => &$string) {
            $string = ucfirst($i === 0 ? str_singular($string) : $string);
        }

        return implode('/', $component);
    }

    /**
     * Add the destroy method for a resourceful route.
     *
     * @param  string  $name
     * @param  string  $base
     * @param  string  $controller
     * @param  array   $options
     * @return \Illuminate\Routing\Route
     */
    protected function addResourceDestroy($name, $base, $controller, $options)
    {
        $uri = $this->getResourceUri($name).'/{'.$base.'?}';
        $action = $this->getResourceAction($name, $controller, 'destroy', $options);

        return $this->router->delete($uri, $action);
    }
}
