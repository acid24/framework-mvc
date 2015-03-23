<?php

namespace Salexandru\Http;

class Request
{

    public function get($key)
    {
        switch (true) {
            case isset($_GET[$key]):
                return $_GET[$key];
            case isset($_POST[$key]):
                return $_POST[$key];
            case isset($_COOKIE[$key]):
                return $_COOKIE[$key];
            case isset($_SERVER[$key]):
                return $_SERVER[$key];
            case isset($_SERVER[$key]):
                return $_SERVER[$key];
            default:
                return null;
        }
    }
    
    public function has($key)
    {
        switch (true) {
            case isset($_GET[$key]):
                return true;
            case isset($_POST[$key]):
                return true;
            case isset($_COOKIE[$key]):
                return true;
            case isset($_SERVER[$key]):
                return true;
            case isset($_ENV[$key]):
                return true;
            default:
                return false;
        }   
    }
    
    public function getRequestUri()
    {
        return $this->getFromServer('REQUEST_URI');
    }
    
    public function getFromPost($key, $default = null)
    {
        return isset($_POST[$key]) ? $_POST[$key] : $default;   
    }
    
    public function getFromGet($key, $default = null)
    {
        return isset($_GET[$key]) ? $_GET[$key] : $default;
    }
    
    public function getFromCookie($key, $default = null)
    {
        return isset($_COOKIE[$key]) ? $_COOKIE[$key] : $default;
    }
    
    public function getFromServer($key, $default = null)
    {
        return isset($_SERVER[$key]) ? $_SERVER[$key] : $default;
    }
    
    public function getFromEnv($key, $default = null)
    {
        return isset($_ENV[$key]) ? $_ENV[$key] : $default;
    }
    
    public function isPost()
    {
        return $this->getFromServer('REQUEST_METHOD') === 'POST';
    }
    
    public function isGet()
    {
        return $this->getFromServer('REQUEST_METHOD') === 'GET';
    }
     

}
