<?php

namespace Salexandru\Model\Persistable\Validator;

class ValidationResult
{

    const CODE_SUCCESS = 1;
    const CODE_ERROR = 0;

    private $code;
    private $lastError;

    public function __construct($code = self::CODE_SUCCESS, $lastError = null)
    {
        $this->code = $code;
        $this->lastError = $lastError;
    }

    public function isSuccess()
    {
        return $this->code === self::CODE_SUCCESS;
    }
    
    public function isError()
    {
        return $this->code === self::CODE_ERROR;
    }
    
    public function getLastError()
    {
        return $this->lastError;
    }

}
