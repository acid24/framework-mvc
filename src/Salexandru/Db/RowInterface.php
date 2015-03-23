<?php

namespace Salexandru\Db;

interface RowInterface extends \Countable
{
    public function getIntValue($col);
    public function getStringValue($col);
    public function getDoubleValue($col);
    public function getBoolValue($col);
    public function getNullValue($col);
    public function getValueAt($col);
    public function getCount();
}
