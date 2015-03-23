<?php

namespace Salexandru\Auth;

class AuthenticationRequest implements \ArrayAccess
{

    private $data = array();
    
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
        $this->data[$offset] = $value;
    }
    
    public function offsetUnset($offset)
    {
        if ($this->offsetExists($offset)) {
            unset($this->data[$offset]);
        }
    }
    
    public function __set($name, $value)
    {
        $this->offsetSet($name, $value);
    }
    
    public function __get($name)
    {
        return $this->offsetGet($name);
    }
    
    public function __isset($name)
    {
        return $this->offsetExists($name);
    }
    
    public function __unset($name)
    {
        $this->offsetUnset($name);
    }

}
