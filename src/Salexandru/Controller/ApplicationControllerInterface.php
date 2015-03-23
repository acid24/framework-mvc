<?php

namespace Salexandru\Controller;

use Salexandru\Http\Request;
use Salexandru\Http\Response;
use Salexandru\View\ViewInterface as View;

interface ApplicationControllerInterface
{
    
    public function setRequest(Request $request);
    public function setResponse(Response $response);
    public function setView(View $view); 

}
