<?php

namespace Salexandru\Auth\Provider;

use Salexandru\Auth\AuthenticationRequest;

interface AuthenticationProviderInterface
{

    public function authenticate(AuthenticationRequest $details);

}
