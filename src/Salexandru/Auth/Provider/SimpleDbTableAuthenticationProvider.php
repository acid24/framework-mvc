<?php

namespace Salexandru\Auth\Provider;

use Salexandru\Db\AdapterInterface as DbAdapter;
use Salexandru\Auth\AuthenticationRequest;
use Salexandru\Auth\Identity;
use Salexandru\Db\Exception\SqlException;
use Salexandru\Auth\Exception\AuthenticationException;
use Salexandru\Auth\Exception\InvalidCredentialsException;

class SimpleDbTableAuthenticationProvider implements AuthenticationProviderInterface
{

    private $dbAdapter;
    private $options;
    
    public function __construct(DbAdapter $dbAdapter, array $options)
    {
        $this->dbAdapter = $dbAdapter;
        $this->options = $options;
    }
    
    public function authenticate(AuthenticationRequest $details)
    {
        $stmt = $this->buildStatement($details->username, $details->password);
        
        try {
            $rowset = $stmt->execute();
        } catch (SqlException $e) {
            throw new AuthenticationException($e->getMessage());
        }
        
        $row = $rowset->current();
        if ($row->getIntValue('rowCount') !== 1) {
            throw new InvalidCredentialsException('Incorrect username and/or password');
        }
        
        $identity = new Identity();
        $identity->token = md5($details->userAgent . $details->salt);
        
        return $identity;   
    }
    
    private function buildStatement($username, $password)
    {
        $table = $this->options['table'];
        $usernameCol = $this->options['username_column'];
        $passwordCol = $this->options['password_column'];
    
        $sql = sprintf("select count(*) as rowCount from %s where %s = :username and %s = :password", $table, $usernameCol, $passwordCol);
        $stmt = $this->dbAdapter->prepareStatement($sql, array('username' => $username, 'password' => $password));
        
        return $stmt;
    }

}
