<?php

namespace Salexandru\Controller;

use Salexandru\Controller\Exception\ExceptionInterface as ControllerException;

class FrontController
{

    private $mvcToolsProvider;
    
    public function __construct(MvcToolsProvider $mvcToolsProvider)
    {
        $this->mvcToolsProvider = $mvcToolsProvider;
    }
    
    public function run()
    {
        $request = $this->mvcToolsProvider->getRequest();
        $response = $this->mvcToolsProvider->getResponse();
        $router = $this->mvcToolsProvider->getRouter();
        $view = $this->mvcToolsProvider->getView();
        
        if (false === ($handler = $router->discoverHandlerFor($request))) {
            throw new \RuntimeException('Unable to find a handler');
        }
        
        $class = new \ReflectionClass($handler['controller']);
        if (!$class->isSubclassOf('Salexandru\Controller\ApplicationControllerInterface')) {
            throw new \RuntimeException('Controller must be a subclass of Salexandru\Controller\ApplicationControllerInterface');
        }
        
        try {
            $controller = $class->newInstanceArgs(array($request, $response, $view));
            $action = $class->getMethod($handler['action']);
        } catch (\ReflectionException $e) {
            throw new \RuntimeException($e->getMessage());
        }
        
        try {     
            $action->invokeArgs($controller, $handler['args']);
        } catch (ControllerException $e) {
            throw new \RuntimeException($e->getMessage());
        }
        
        $content = $view->render();
        
        $response->setContent($content);
        $response->send();
    }

}
