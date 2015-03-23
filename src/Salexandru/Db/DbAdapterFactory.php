<?php

namespace Salexandru\Db;

use Salexandru\Db\Pdo\PdoAdapter;
use Salexandru\Db\Exception\DomainException;
use Salexandru\Db\Exception\MissingRequiredConfigurationOptionException;
use Salexandru\Db\Exception\DatabaseConnectionErrorException;

class DbAdapterFactory
{

    public function createAdapter($type, array $options = null)
    {
        switch (strtolower($type)) {
            case 'pdo_mysql':
                return $this->createPdoMysqlAdapter($options);
            default:
                throw new DomainException(sprintf('Adapter type %s is not supported', $type));
        }
    }
    
    private function createPdoMysqlAdapter(array $options)
    {
        $defaults = array(
            'dbname' => null, 
            'host' => '127.0.0.1',
            'dbuser' => '',
            'dbpass' => '',
            'charset' => 'UTF-8',
            'driver_options' => array()
        );
        
        $options = array_replace_recursive($defaults, $options);
        
        if (!isset($options['dbname'])) {
            throw new MissingRequiredConfigurationOptionException('"dbname" option must be provided');
        }
        
        $dsn = sprintf('mysql:dbname=%s;host=%s;charset=%s', $options['dbname'], $options['host'], $options['charset']);
        
        try {
            $pdo = new \PDO($dsn, $options['dbuser'], $options['dbpass'], $options['driver_options']);
        } catch (\PDOException $e) {
            throw new DatabaseConnectionErrorException($e->getMessage());
        }
        
        return new PdoAdapter($pdo);
    } 

}
