<?php



// dump a variable and die the program (for debugging)
function dd($data)
{
    echo "<pre style='background-color:#607D8B;color:white;padding:10px;line-height:1.3;direction:ltr !important;text-align:left!important;'>";
    print_r($data);
//    var_dump($data);
    echo "</pre>";
    die();
}



// dump a variable and continue the program (for debugging)
function dump($data)
{
    echo "<pre style='background-color:#607D8B;color:white;padding:10px;line-height:1.3;direction:ltr !important;text-align:left!important;'>";
    print_r($data);
    echo "</pre>";
}



// escape back ticks for prevent sql injection
function sanitize($dirty)
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
function currentUser()
{
    return Users::currentLoggedInUser();
}



function getObjectProperties($obj)
{
    return get_object_vars($obj);
}
