<?php

namespace Salexandru\Db\Pdo;

use Salexandru\Db\RowSetInterface as DbRowSet;
use Salexandru\Db\Row;
use Salexandru\Db\Exception\UnsupportedOperationException;

class PdoRowSet implements DbRowSet
{

    private $stmt;
    private $row;
    private $counter;
    
    public function __construct(\PDOStatement $stmt)
    {
        if (false !== ($row = $stmt->fetch(\PDO::FETCH_BOTH))) {
            $this->stmt = $stmt;
            $this->row = $row;
            $this->counter = 0;
        }
    }
    
    public function current()
    {
        $row = $this->row;
        if (null !== $row) {
            $row = new Row($row);
        }
        
        return $row;
    }
    
    public function key()
    {
        return $this->counter;    
    }
    
    public function next()
    {
        $this->nextRow();
    }

    public function rewind()
    {
        throw new UnsupportedOperationException('Rewinding is not supported for this type of row set');
    }
    
    public function valid()
    {
        return null !== $this->row;
    }
    
    private function nextRow()
    {
        if (false !== ($row = $this->stmt->fetch(\PDO::FETCH_BOTH))) {
            $this->row = $row;
            $this->counter++;
        } else {
            $this->row = null;
            $this->counter = null;
        }   
    }

}
