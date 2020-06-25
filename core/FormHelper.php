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
    
    

    public static function inputBlock($type, $label, $name, $value = '', $inputAttrs = [])
    {
        $inputString = self::stringifyAttributes($inputAttrs);

        $html = '<div class="form-group mb-4">'
                  . '<label for="' . $name . '">' . $label . '</label>'
                  . '<input type="' . $type . '" id="' . $name . '" name="' . $name . '" value="' . $value . '"' . $inputString . ' class="form-control text-center" />'
              . '</div>';
        return $html;
    }

    
    
    public static function submitTag($buttonText, $inputAttrs = [])
    {
        $inputString = self::stringifyAttributes($inputAttrs);

        $html = '<input type="submit" value="' . $buttonText . '"' . $inputString . ' />';
        return $html;
    }

    
    
    public static function submitBlock($buttonText, $inputAttrs = [], $divAttrs = [])
    {
        $divString = self::stringifyAttributes($divAttrs);
        $inputString = self::stringifyAttributes($inputAttrs);

        $html = "<div $divString>"
                  . '<input type="submit" value="' . $buttonText .'"' . $inputString . ' />'
              . '</div>';
        return $html;
    }

    
    
    public static function checkboxBlock($label, $name, $checked = false, $inputAttrs = [])
    {
        $inputString = self::stringifyAttributes($inputAttrs);
        $checkString = $checked ? ' checked="checked"' : '';
        
        $html = '<div class="custom-control custom-checkbox mr-sm-2" style="color:#a4a4a4;">'
                   . '<input type="checkbox" class="custom-control-input" id="' . $name . '" name="' . $name . '" value="on"' . $checkString . $inputString.'>'
                   . '<label class="custom-control-label mb-1" for="' . $name . '">' . $label . '</label>'
              . '</div>';
        return $html;
    }

    
    
    public static function stringifyAttributes($attributes)
    {
        $string = '';
        foreach ($attributes as $key => $value)
            $string .= ' ' . $key . '="' . $value . '"';
        return $string;
    }
    
    
    
    public static function posted_values($post) 
    {
        $clean_ary = [];
        foreach ($post as $key => $value)
            $clean_ary[$key] = self::sanitize($value);
        return $clean_ary;
    }

    
    
    public static function displayErrors($errors)
    {
        $hasErrors = !empty($errors) ? ' has-errors' : '';

        $html = '<div class="form-errors"><ul class="bg-danger'.$hasErrors.'">';
        foreach ($errors as $field => $error) {
            $html .= '<li class="text-danger">' . $error . '</li>';
            $html .= '<script>jQuery("document").ready(function(){jQuery("#'.$field.'").parent().closest("div").addClass("has-error");});</script>';
        }
        $html .= '</ul></div>';
        return $html;
    }



}