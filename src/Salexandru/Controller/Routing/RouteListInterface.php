<?php

namespace Salexandru\Controller\Routing;

interface RouteListInterface extends \IteratorAggregate, \Countable
{

    public function addRoute(RouteInterface $route);
    public function toArray();

}
