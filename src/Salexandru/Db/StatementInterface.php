<?php

namespace Salexandru\Db;

interface StatementInterface
{
    public function execute();
    public function getAdapter();
}
