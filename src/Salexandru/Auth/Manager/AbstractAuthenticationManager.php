<?php

namespace Salexandru\Auth\Manager

use Salexandru\Auth\Provider\AuthenticationProviderInterface as AuthProvider;
use Salexandru\Auth\IdentityStorage\IdentityStorageInterface as IdentityStorage;

abstract class AbstractAuthenticationManager implements AuthenticationManagerInterface
{

    protected $authProvider;
    protected $identityStorage;
    protected $errorCode;
    protected $errorMessage;
    
    public function __construct(AuthProvider $authProvider, IdentityStorage $identityStorage)
    {
        $this->authProvider = $authProvider;
        $this->identityStorage = $identityStorage;
    }
    
    public function authenticate(AuthenticationRequest $details)
    {
        try {
            $identity = $this->authProvider->authenticate($details);
            $this->identityStorage->store($identity);    
        } catch (InvalidCredentialsException $e) {
            $this->errorCode = AuthenticationManagerInterface::AUTH_ERROR_INVALID_CREDENTIALS;
            $this->errorMessage = $e->getMessage();
            return false;
        } catch (AuthenticationException $e) {
            $this->errorCode = AuthenticationManagerInterface::AUTH_ERROR_GENERIC;
            $this->errorMessage = $e->getMessage();
            return false;
        }
        
        return true;
    }
    
    public function hasIdentity()
    {
        if ($this->identityStorage->isEmpty()) {
            return false;
        }
        
        return true;
    }
    
    public function getIdentity()
    {
        return $this->identityStorage->getIdentity();
    }
    
    public function clearIdentity()
    {
        $this->identityStorage->clear();
    }
    
    public function getErrorCode()
    {
        return $this->errorCode;
    }
    
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

}
