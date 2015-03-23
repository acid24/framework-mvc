<?php

namespace Salexandru\Controller\Routing;

interface RouteInterface
{

    public function matches($path);
    public function getArgs();
    public function getController();
    public function getAction();

}
