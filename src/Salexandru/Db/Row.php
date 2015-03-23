<?php

namespace Salexandru\Db;

use Salexandru\Db\Exception\InvalidArgumentException;
use Salexandru\Db\Exception\OffsetNotFoundException;

class Row implements RowInterface
{

    private $row;

    public function __construct(array $row)
    {
        $this->row = $row;
    }
    
    public function getIntValue($col)
    {
        $value = $this->getValueAt($col);
        return (int)$value;
    }
    
    public function getStringValue($col)
    {
        return $this->getValueAt($col);
    }
    
    public function getDoubleValue($col)
    {
        $value = $this->getValueAt($col);
        return (float)$value;        
    }
    
    public function getNullValue($col)
    {
        $value = $this->getValueAt($col);
        if ($value == '') {
            return null;
        }
        
        return $value;
    }
    
    public function getBoolValue($col)
    {
        $value = $this->getValueAt($col);
        return(bool)$value;
    }
    
    public function getValueAt($offset)
    {
        $this->ensureValidOffset($offset);
    
        return $this->row[$offset];
    }
    
    public function count()
    {
        return count($this->row);
    }
    
    private function ensureValidOffset($offset)
    {
        if (!is_int($offset) && !is_string($offset)) {
            throw new InvalidArgumentException(sprintf('Expected string or int offset; got %s', gettype($offset)));
        }
        
        if (!isset($this->row[$offset])) {
            throw new OffsetNotFoundException(sprintf('Offset %s not found', $offset));
        }
    }

}
