<?php

namespace Salexandru\Db;

interface PreparedStatementInterface extends StatementInterface
{
    public function setIntParam($param, $value);
    public function setNullParam($param, $value);
    public function setBoolParam($param, $value);
    public function setStringParam($param, $value);
}
