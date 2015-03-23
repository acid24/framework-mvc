<?php

namespace Salexandru\Http;

class Response
{

    private $headers = array();
    private $content;
    private $httpCode = 200;
    
    public function addHeader($name, $value)
    {
        $this->headers[$name] = $value;
    }
    
    public function setContent($content)
    {
        $this->content = $content;
    }
    
    public function setHttpCode($code)
    {
        $this->httpCode = $code;
    }
    
    public function outputContent()
    {
        echo $this->content;
    }
    
    public function sendHeaders()
    {
        if (!headers_sent()) {
            foreach ($this->headers as $header => $value) {
                header(sprintf('%s: %s', $header, $value), true, $this->httpCode);
            }
        }
    }
    
    public function send()
    {
        $this->sendHeaders();
        $this->outputContent();
    }

}


