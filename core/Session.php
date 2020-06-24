<?php
class Session {



    public static function exists($name)
    {
        return (isset($_SESSION[$name])) ? true : false;
    }



    public static function get($name)
    {
        return $_SESSION[$name];
    }



    public static function set($name, $value)
    {
        return $_SESSION[$name] = $value;
    }



    public static function delete($name)
    {
        if (isset($_SESSION[$name])) unset($_SESSION[$name]);
    }



    public static function uagent_no_version()
    {
        return preg_replace('/\/[a-zA-Z0-9.]+/', '', $_SERVER['HTTP_USER_AGENT']);
    }



}
