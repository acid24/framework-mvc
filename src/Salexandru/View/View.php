<?php

namespace Salexandru\View;

use Salexandru\View\Exception\InvalidArgumentException;
use Salexandru\View\Exception\UnexpectedValueException;

class View implements ViewInterface
{

    private $vars = array();
    private $templatePath;
    private $templateName;
    
    public function setTemplatePath($path)
    {
        $this->templatePath = $path;
    }
    
    public function getTemplatePath()
    {
        return $this->templatePath;
    }
    
    public function assign($templateName, array $vars = null)
    {
        $this->templateName = $templateName;
        if (null !== $vars) {
            $this->vars = $vars;
        }
    }
    
    public function clearVariables()
    {
        $this->vars = array();
    }
    
    public function render()
    {
        $template = $this->buildTemplatePath();
        
        ob_start();
        require $template;
        $content = ob_get_clean();
        
        return $content;
    }

    public function __isset($name)
    {
        return array_key_exists($name, $this->vars);
    }
    
    public function __unset($name)
    {
        if (isset($this->$name)) {
            unset($this->vars[$name]);
        }
    }
    
    public function __get($name)
    {
        return $this->getVariable($name);
    }
    
    public function __set($name, $value)
    {
        $this->addVariable($name, $value);
    }
    
    private function buildTemplatePath()
    {
        $path = null;
        if (isset($this->templatePath)) {
            $path = rtrim($this->templatePath, '/') . '/' . $this->templateName;    
        }
        
        $this->ensureValidTemplate($path);
        
        return $path;    
    }
    
    private function ensureValidTemplate($path)
    {
        if (null === $path) {
            throw new UnexpectedValueException('Template path not set');
        }
    
        if (!file_exists($path) && !is_file($path) && !is_readable($path)) {
            throw new InvalidArgumentException(sprintf('File %s does not exist, is not a file or is not readable', $path));
        }
    }

}
