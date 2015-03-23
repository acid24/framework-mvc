<?php

namespace Salexandru\Auth\Manager;

use Salexandru\Auth\Provider\AuthenticationProviderInterface as AuthProvider;
use Salexandru\Auth\IdentityStorage\IdentityStorageInterface as IdentityStorage;
use Salexandru\Auth\IdentityStorage\NoIdentityStorage;
use Salexandru\Auth\Exception\InvalidCredentialsException;
use Salexandru\Auth\Exception\AuthenticationException;

class DefaultAuthenticationManager extends AbstractAuthenticationManager
{

    public function __construct(AuthProvider $authProvider, IdentityStorage $identityStorage = null)
    {
        $this->authProvider = $authProvider;
        $this->identityStorage = $identityStorage ?: new NoIdentityStorage();
    }

}
