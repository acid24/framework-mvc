<?php

namespace Salexandru\Auth\IdentityStorage;

class NoIdentityStorage implements IdentityStorageInterface
{

    public function store(Identity $identity)
    {
        // do nothing
    }
    
    public function getIdentity()
    {
        return null;
    }
    
    public function isEmpty()
    {
        return true;
    }
    
    public function clear()
    {
        // do nothing
    }

}
