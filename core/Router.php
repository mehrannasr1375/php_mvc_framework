<?php
class Router {



    public static function route($url)
    {
        // get controller
        $controller = isset($url[0]) && $url[0] != '' ? ucwords($url[0]).'Controller' : DEFAULT_CONTROLLER.'Controller'; // SampleController
        $controller_name = str_replace('Controller', '', $controller);// Sample
        array_shift($url);
        if (! class_exists($controller))
            die("class '" . $controller . "' does not exists!");

        // get action
        $action = isset($url[0]) && $url[0] != '' ? $url[0] : 'index';
        array_shift($url);

        // acl check
        if (! self::hasAccess($controller_name, $action)) {
            $controller_name = ACCESS_RESTRICTED;
            $controller = ACCESS_RESTRICTED.'Controller';
            $action = 'index';
        }

        // get params
        $queryParams = $url;
        $dispatch = new $controller($controller_name, $action);

        // run method of controller
        if (method_exists($controller, $action))
            call_user_func_array([$dispatch, $action], $queryParams);
        else
            die("method '" . $action . "' does not exists on controller '" . $controller_name . "'!");
    }



    public static function redirect($url)
    {
        if (! headers_sent()) {
            header('Location: ' . PROOT . $url);
            exit();
        }
        else {
            echo '<script type="text/javascript">';
            echo 'window.location.href="'.PROOT.$url.'";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
            echo '</noscript>';
            exit();
        }
    }



    public static function hasAccess($controller_name, $action = 'index')
    {
        $acl_file = file_get_contents(ROOT.DS.'app'.DS.'acl.json');
        $acl = json_decode($acl_file, true);
        $current_user_acls = ["Guest"];
        $grantAccess = false;

        // determine access levels of user
        if (Session::exists(CURRENT_USER_SESSION_NAME)) {
            $current_user_acls[] = "LoggedIn";
            if (is_array(currentUser()->acls()))
                foreach (currentUser()->acls() as $ac)
                    $current_user_acls[] = $ac;
        }

        // check `controller` & `action` existance on acl
        foreach ($current_user_acls as $level) { // iterate loop trough each access level in acl.json
            if (array_key_exists($level, $acl) && array_key_exists($controller_name, $acl[$level])) {
                if (in_array($action, $acl[$level][$controller_name]) || in_array('*', $acl[$level][$controller_name])) {
                    $grantAccess = true;
                    break;
                }
            }
        }

        // check for denied
        foreach ($current_user_acls as $level) {
            if (array_key_exists($level, $acl) && array_key_exists('denied',$acl[$level])) {
                if (array_key_exists($controller_name, $acl[$level]['denied']) && array_key_exists($action, $acl[$level]['denied'][$controller_name])) {
                    $grantAccess = false;
                    break;
                }
            }
        }

        return $grantAccess;
    }



}
