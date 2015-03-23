<?php

namespace Salexandru\Auth\IdentityStorage;

interface IdentityStorageInterface
{

    public function store(Identity $identity);
    public function getIdentity();
    public function isEmpty();
    public function clear();

}
