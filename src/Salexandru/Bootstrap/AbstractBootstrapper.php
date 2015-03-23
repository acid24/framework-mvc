<?php

namespace Salexandru\Bootstrap;

use Salexandru\Config\Config;
use Salexandru\Bootstrap\Exception\BootstrappingException;

abstract class AbstractBootstrapper
{
    
    protected $config;
    
    public function bootstrap($config)
    {
        try {
            $this->config = Config::loadFromPath($config);
            $this->runBootstrappingMethods();
        } catch (\Exception $e) {
            throw new BootstrappingException('An error occurred during bootstrapping process', $e);
        }
    }
    
    protected function runBootstrappingMethods()
    {
        $r = new \ReflectionObject($this);
        
        $bootstrappingMethodFilter = function(\ReflectionMethod $m) { 
            return strpos($m->getName(), 'init') === 0; 
        };
        $methods = array_filter($r->getMethods(), $bootstrappingMethodFilter); 
        
        foreach ($methods as $method) {
            $method->invoke($this);
        }
    }

}
