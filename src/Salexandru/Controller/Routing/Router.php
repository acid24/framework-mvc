<?php

namespace Salexandru\Controller\Routing;

use Salexandru\Http\Request;

class Router implements RouterInterface
{

    private $routeList;
    
    public function __construct(RouteList $routeList)
    {
        $this->routeList = $routeList;
    }

    public function discoverHandlerFor(Request $request)
    {
        $found = false;
        foreach ($this->routeList as $route) {
            if ($route->matches($request->getRequestUri()) {
                $found = true;
                break;
            }
        }
        
        if ($found) {
            return array(
                'controller' => $route->getController(),
                'action' => $route->getAction(),
                'args' => $route->getArgs()
            );
        }
        
        return false;
    }

}
