<?php
class Helpers
{



    // dump a variable and die the program (for debugging)
    public static function dd($data)
    {
        echo "<pre style='background-color:#607D8B;color:white;padding:10px;line-height:1.3;direction:ltr !important;text-align:left!important;'>";
        print_r($data);
        echo "</pre>";
        die();
    }



    // dump a variable and continue the program (for debugging)
    public static function dump($data)
    {
        echo "<pre style='background-color:#607D8B;color:white;padding:10px;line-height:1.3;direction:ltr !important;text-align:left!important;'>";
        print_r($data);
        echo "</pre>";
    }



    // escape back ticks for prevent sql injection
    public static function sanitize($dirty)
    {
        if (is_array($dirty)) {
            $clean_arr = [];
            foreach ($dirty as $key => $value)
                $clean_arr[htmlentities($key, ENT_QUOTES, 'UTF-8')] = htmlentities($value, ENT_QUOTES, 'UTF-8');

            return $clean_arr;
        }
        else
            return htmlentities($dirty, ENT_QUOTES, 'UTF-8');
    }



    // return current logged in user as an object
    public static function currentUser()
    {
        return Users::currentLoggedInUser();
    }



    public static function getObjectProperties($obj)
    {
        return get_object_vars($obj);
    }



}