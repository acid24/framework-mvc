<?php

namespace Salexandru\Model\Persistable;

use Salexandru\Model\PersistableInterface as Persistable;

interface PersisterInterface
{

    public function create(Persistable $object);
    public function update(Persistable $object);
    public function delete(Persistable $object);

}
