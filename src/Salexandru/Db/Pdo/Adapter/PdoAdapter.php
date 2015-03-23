<?php

namespace Salexandru\Db\Pdo\Adapter;

use Salexandru\Db\AdapterInterface as DbAdapter;
use Salexandru\Db\Statement\PdoStatement;

class PdoAdapter implements DbAdapter
{

    private $pdo;
    
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function beginTransaction()
    {
        return $this->pdo->beginTransaction();
    }
    
    public function commitTransaction()
    {
        return $this->pdo->commit();
    }
    
    public function rollbackTransaction()
    {
        return $this->pdo->rollback();
    }
    
    public function createStatement($sql)
    {
        $stmt = $this->pdo->prepare($sql);
        return new PdoStatement($this, $stmt);
    }
    
    public function prepareStatement($sql, array $params = null)
    {
        $stmt = $this->createStatement($sql);
        if (null !== $params && count($params) > 0) {
            $params = $this->normalizeParams($params);
            foreach ($params as $name => $value) {
                $stmt->setStringParam($name, $value);
            }
        }
        
        return $stmt;
    }
    
    public function executeQuery($query)
    {
        return $this->pdo->exec($query);
    }
    
    private function normalizeParams(array $params)
    {
        $paramsType = $this->inferParamsType($params);
        
        if ($paramsType === 'positional') {
            $keys = range(1, count($params));
            return array_combine($keys, $params);    
        } else {
            $normalized = array();
            foreach ($params as $name => $value) {
                if ($name[0] !== ':') {
                    $name = ":$name";
                }
                
                $normalized[$name] = $value;
            }
            
            return $normalized;
        }
    }
    
    private function inferParamsType(array $params)
    {
        if ($params === array_values($params)) {
            return 'positional';
        }
        
        return 'named';
    }

}
