<?php

namespace Salexandru\Autoloader\PsrZeroAutoloader;

class PsrZeroAutoloader
{

    public function register()
    {
        spl_autoload_register(array($this, 'loadClass'));
    }
    
    public function unregister()
    {
        spl_autoload_unregister(array($this, 'loadClass'));
    }
    
    public function loadClass($className)
    {
        $file = sprintf('%s.php', str_replace(array('\\', '_'), DIRECTORY_SEPARATOR, $className));
        require $file;
    }

}
