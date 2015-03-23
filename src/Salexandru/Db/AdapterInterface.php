<?php

namespace Salexandru\Db;

interface AdapterInterface
{
    public function beginTransaction();
    public function commitTransaction();
    public function rollbackTransaction();
    public function createStatement($sql);
    public function prepareStatement($sql, array $params = null);
    public function executeQuery($query);
}
