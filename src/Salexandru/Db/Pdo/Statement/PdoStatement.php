<?php

namespace Salexandru\Db\Pdo\Statement;

use Salexandru\Db\PreparedStatementInterface as DbStatement;
use Salexandru\Db\Adapter\PdoAdapter;
use Salexandru\Db\RowSet\PdoRowSet;
use Salexandru\Db\Exception\SqlException;

class PdoStatement implements DbStatement
{

    private $adapter;
    private $stmt;
    
    public function __construct(PdoAdapter $adapter, \PDOStatement $stmt)
    {
        $this->adapter = $adapter;
        $this->stmt = $stmt;
    }
    
    public function execute()
    {
        try {
            $this->stmt->execute();
        } catch (\PDOException $e) {
            throw new SqlException($e->getMessage());
        }
        
        return new PdoRowSet($this->stmt); 
    }
    
    public function getAdapter()
    {
        return $this->adapter;
    }
    
    public function setIntParam($name, $value)
    {
        $this->stmt->bindValue($name, $value, \PDO::PARAM_INT);
    }
    
    public function setNullParam($name, $value)
    {
        $this->stmt->bindValue($name, $value, \PDO::PARAM_NULL);
    }
    
    public function setBoolParam($name, $value)
    {
        $this->stmt->bindValue($name, $value, \PDO::PARAM_BOOL);
    }
    
    public function setStringParam($name, $value)
    {
        $this->stmt->bindValue($name, $value, \PDO::PARAM_STR);
    }

}
