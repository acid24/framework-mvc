<?php

namespace Salexandru\Controller;

interface MvcToolsProviderInterface
{

    public function getRouter();
    public function getView();
    public function getRequest();
    public function getResponse();

}
