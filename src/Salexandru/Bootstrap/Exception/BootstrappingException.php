<?php

namespace Salexandru\Bootstrap\Exception;

class BootstrappingException extends \RuntimeException implements ExceptionInterface
{
    public function __construct($message, \Exception $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}
