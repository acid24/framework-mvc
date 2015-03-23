<?php

namespace Salexandru\Auth\Manager;

interface AuthenticationManagerInterface
{

    const AUTH_ERROR_GENERIC = 0;
    const AUTH_ERROR_INVALID_CREDENTIALS = -1;

    public function authenticate(AuthenticationRequest $details);
    public function hasIdentity();
    public function getIdentity();
    public function clearIdentity();
    public function getErrorCode();
    public function getErrorMessage();

}
