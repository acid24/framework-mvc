<?php

namespace Salexandru\Config\Loader;

use Salexandru\Config\Config;
use Salexandru\Config\Loader\Exception\UnexpectedValueException;

class PhpConfigLoader implements ConfigLoaderInterface
{

    private $path;
    private $configPrototype;

    public function __construct($path, Config $configPrototype = null)
    {
        $this->path = $path;
        $this->configPrototype = $configPrototype ?: new Config();
    }
    
    public function load()
    {
        set_error_handler(function() { return true; }, E_WARNING);
        $configArray = include $this->path;
        restore_error_handler();
        
        if (!is_array($configArray)) {
            throw new UnexpectedValueException('Configuration file must return an array');
        }
        
        $config = clone $this->configPrototype;
        $config->init($configArray);
        
        return $config;
    }

}
