<?php

namespace Salexandru\Config;

use Salexandru\Config\Exception\DomainException;
use Salexandru\Config\Exception\InvalidArgumentException;

class Config implements Countable, ArrayAccess
{

    private $data = array();
    
    public function __construct(array $data = array())
    {
        if (!empty($data)) {
            $this->init($data);
        }
    }
    
    public function count()
    {
        return count($this->data);    
    }
    
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->data);
    }
    
    public function offsetGet($offset)
    {
        if ($this->offsetExists($offset)) {
            return $this->data[$offset];
        }
    }
    
    public function offsetSet($offset, $value)
    {
        if (is_array($value)) {
            $value = new static($value);
        }
         
        $this->data[$offset] = $value;
    }
    
    public function offsetUnset($offset)
    {
        if ($this->offsetExists($offset)) {
            unset($this->data[$offset]);
        }
    }
    
    public function toArray()
    {
        $data = $this->data;
        foreach ($data as $key => $value) {
            if ($value instanceof static) {
                $value = $value->toArray();
            }
            
            $data[$key] = $value;
        }
        
        return $data;
    }
    
    public static function loadFromPath($path)
    {
        clearstatcache();
        if (!file_exists($path) && !is_file($path) && !is_readable($path)) {
            throw new InvalidArgumentExceptio('Invalid config path provided');
        }
        
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        if (strtolower($ext) !== 'php') {
            throw DomainException('Only php configuration files are supported');
        }
        
        $loader = new PhpConfigLoader($path);
        $config = $loader->load();
        
        return $config;
    }
    
    public function init(array $data)
    {
        foreach ($data as $offset => $value) {
            $this->offsetSet($offset, $value);
        }
    }
    
    public function __clone()
    {
        foreach ($this->data as $offset => $value) {
            if ($value instanceof static) {
                $this->data[$offset] = clone $value;
            }
        }
    }

}
