<?php

namespace Salexandru\Model\Persistable;

use Salexandru\Model\Persistable\CriteriaInterface as Criteria;

interface FinderInterface
{

    public function findMatching(Criteria $criteria);
    
}
