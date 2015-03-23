<?php

namespace Salexandru\Controller;

use Salexandru\Config\Config;
use Salexandru\View\View;
use Salexandru\Http\Request;
use Salexandru\Http\Response;
use Salexandru\Controller\Routing\Router;
use Salexandru\Controller\Routing\Route;
use Salexandru\Controller\Routing\RouteList;

class MvcToolsProvider extends MvcToolsProviderInterface
{

    private $config;
    
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function getRouter()
    {
        $routeDefinitions = $this->config->routes->toArray();
        
        $initial = array(
            'path' => null,
            'controller' => null,
            'action' => null,
            'params' => null,
            'defaults' => null,
            'rules' => null
        );
        
        $routesList = new RoutesList();
        
        foreach ($routeDefinitions as $name => $info) {
            $info = array_merge($initial, $info);
            extract($info, EXTR_SKIP);
            
            if (isset($path) && isset($controller) && isset($action)) {
                $routesList->addRoute(new Route($path, $controller, $action, $params, $defaults, $rules));
            }
        }
        
        return new Router($routesList);
    }
    
    public function getView()
    {
        $config = $this->config->view;
        
        $view = new View();
        $view->setTemplatePath($config->templatePath);
        
        return $view;
    }
    
    public function getRequest()
    {
        return new Request();    
    }
    
    public function getResponse()
    {
        return new Response();
    }

}
