<?php
class Application {


    public function __construct()
    {
        $this->_set_reporting();
        $this->_unregister_globals();
    }
    
    
    private function _set_reporting() 
    {
        if (DEVELOPING_MODE == true) {
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
        }
        else {
            ini_set('display_errors', 0);
            error_reporting(0);
            ini_set('log_errors', 1);
            ini_set('error_log', ROOT . DS . 'tmp' . DS . 'logs' . DS . 'errors.log');
        }
    }
    
    
    private function _unregister_globals()
    {
        if (ini_get('register_globals')) {
            $globalsArray = ['_SESSION', '_COOKIE', '_POST', '_GET', '_SERVER', '_ENV', '_FILES', 'REQUEST'];
            foreach ($globalsArray as $global) {
               if (isset($GLOBALS[$global])) {
                    foreach ($GLOBALS[$global] as $key => $value) {
                        if (isset($GLOBALS[$key])) {
                            if ($GLOBALS[$key] === $value) {
                                unset($GLOBALS[$key]);
                            }
                        }
                    }
                }
            }
        }
    }
    
    
}
