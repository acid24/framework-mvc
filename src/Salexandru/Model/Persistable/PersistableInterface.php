<?php

namespace Salexandru\Model\Persistable;

use Salexandru\Model\Persistable\Validator\PersistableValidatorInterface as Validator;

interface PersistableInterface
{

    public function loadFromArray(array $data);
    public function isValid(Validator $validator);
    public function getValidableProperties();

}
