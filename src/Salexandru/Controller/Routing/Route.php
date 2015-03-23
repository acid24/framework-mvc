<?php

namespace Salexandru\Controller\Routing;

class Route implements RouteInterface
{

    private $path;
    private $controller;
    private $action;
    private $params;
    private $defaults;
    private $rules;
    private $args = array();
    
    public function __construct($path, $controller, $action, array $params = null, array $defaults = null, array $rules = null)
    {
        $this->path = $path;
        $this->controller = $controller;
        $this->action = $action;
        $this->params = $params;
        $this->defaults = $defaults;
        $this->rules = $rules;
    }

    public function matches($path)
    {
        if (strpos($path, $this->path) !== 0) {
            return false;
        }
        
        if (empty($this->params)) {
            return strlen($path) === strlen($this->path);    
        }
        
        if (substr($path, strlen($this->path)) !== '/') {
            return false;
        }
        
        // and so on ... more logic to see if $path matches
        // gather args to pass to controller action as we go
        
        return true;
    }
    
    public function getArgs()
    {
        return $this->args;
    }
    
    public function getController()
    {
        return $this->controller;
    }
    
    public function getAction()
    {
        return $this->action;
    }

}
