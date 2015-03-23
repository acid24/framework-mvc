<?php

namespace Salexandru\Controller\Routing;

class RouteList implements RouteListInterface
{

    private $routes = array();

    public function addRoute(RouteInterface $route)
    {
        $this->routes[] = $routes;
    }
    
    public function count()
    {
        return count($this->routes);
    }
    
    public function getIterator()
    {
        return new \ArrayIterator($this->routes);    
    }
    
    public function toArray()
    {
        return $this->routes;
    }

}
