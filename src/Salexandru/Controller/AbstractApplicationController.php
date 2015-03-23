<?php

namespace Salexandru\Controller;

use Salexandru\Http\Request;
use Salexandru\Http\Response;
use Salexandru\View\ViewInterface as View;

abstract class AbstractApplicationController implements ApplicationControllerInterface 
{

    public function __construct(Request $request = null, Response $response = null, View $view = null)
    {
        $this->request = $request;
        $this->response = $response;
        $this->view = $view;
    }
    
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }
    
    public function setResponse(Response $response)
    {
        $this->response = $response;
    }
    
    public function setView(View $view)
    {
        $this->view = $view;
    }

}
