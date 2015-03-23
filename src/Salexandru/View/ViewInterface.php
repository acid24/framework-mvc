<?php

namespace Salexandru\View;

interface ViewInterface
{

    public function setTemplatePath($path);
    public function getTemplatePath();
    public function assign($templateName, array $vars = null);
    public function clearVariables();
    public function render();

}
