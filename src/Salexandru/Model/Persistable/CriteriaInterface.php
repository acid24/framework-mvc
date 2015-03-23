<?php

namespace Salexandru\Model\Persistable;

interface CriteriaInterface
{

    public function toSql($sql);

}
