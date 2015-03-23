<?php

namespace Salexandru\Model\Persistable;

use Salexandru\Model\Persistable\Validator\PersistableValidatorInterface as Validator;

abstract class AbstractPersistable implements PersistableInterface
{

    public function __construct(array $data = null)
    {
        if (null !== $data) {
            $this->loadFromArray($data);
        }
    }
    
    public function isValid(Validator $validator)
    {
        $result = $validator->validate($this);
        return $result->isSuccess();
    }
    
    public function loadFromArray(array $data)
    {
        foreach ($data as $key => $value) {
            $setter = 'set' . ucfirst($key);
            if (method_exists($this, $setter)) {
                $this->$setter($key, $value);
            }
        }
    }

}
