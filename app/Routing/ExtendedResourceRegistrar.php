<?php

namespace App\Routing;

use Illuminate\Routing\ResourceRegistrar;

class ExtendedResourceRegistrar extends ResourceRegistrar
{
    protected function addResourceGrid($name, $base, $controller, $options)
    {
        $uri = $this->getResourceUri($name) . '/grid';

        $action = $this->getResourceAction($name, $controller, 'grid', $options);

        return $this->router->get($uri, $action);
    }

    protected function getResourceMethods($defaults, $options = [])
    {
        // Add grid to the default methods
        return array_merge(['grid'], parent::getResourceMethods($defaults, $options));
    }
}
