<?php
// define base constants
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));


// load configs
require_once(ROOT . DS . 'config' . DS . 'config.php');


// class autoloader
spl_autoload_register(function($className) {

    if (file_exists(ROOT . DS . 'core' . DS . $className . '.php'))
        require_once(ROOT . DS . 'core' . DS . $className . '.php');

    else if (file_exists(ROOT . DS . 'app' . DS . 'controllers' . DS . $className . '.php'))
        require_once(ROOT . DS . 'app' . DS . 'controllers' . DS . $className . '.php');

    else if (file_exists(ROOT . DS . 'app' . DS . 'models' . DS . $className . '.php'))
        require_once(ROOT . DS . 'app' . DS . 'models' . DS . $className . '.php');

    else
        die("class '" . $className . "' does not exists !");

});


// start sessions
session_start();


// login with cookie
if (! Session::exists(CURRENT_USER_SESSION_NAME) && Cookie::exists(REMEMBER_ME_COOKIE_NAME))
    Users::loginUserFromCookie();


// get url & route
$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : [];
Router::route($url);
