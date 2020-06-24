<?php
class FormHelper
{



    public static function generateToken()
    {
        $token = base64_encode(openssl_random_pseudo_bytes(32));
        Session::set('csrf_token', $token);
        return $token;
    }



    public static function checkToken($token)
    {
        return (Session::exists('csrf_token') && Session::get('csrf_token') == $token);
    }



    public static function csrfInput()
    {
        return '<input type="hidden" name="csrf_token" id="csrf_token" value="' . self::generateToken() . '" />';
    }



}