<?php
class Validate {

    private $passed = false;
    private $errors = [];
    private $db = null;
 
 
 
    public function __construct()
    {
        $this->db = DB::getInstance();
    }
    
    
    
    public function check($source, $items=[], $csrfCheck = false)
    {
        $this->errors = [];

        // csrf check
        if ($csrfCheck) {
            $csrf_passed = FormHelper::checkToken($source['csrf_token']);
            if (! isset($source['csrf_token']) || !$csrf_passed)
                $this->addError('خطایی رخ داده است!');
        }

        foreach ($items as $item => $rules_arr) {
            $item = Input::sanitize($item);
            $display = $rules_arr['display'];
            foreach ($rules_arr as $rule_name => $rule_value) {
                $value = Input::sanitize(trim($source[$item]));
                if ($rule_name === 'required' && empty($value)) {
                    $this->addError(["{$display} ضروری است !", $item]);
                }
                else if (!empty($value)) {
                    switch ($rule_name) {

                        case 'min':
                            if (strlen($value) < $rule_value)
                                $this->addError(["{$display} باید شامل حداقل {$rule_value} کاراکتر باشد !", $item]);
                            break;
                            
                        case 'max':
                            if (strlen($value) > $rule_value)
                                $this->addError(["{$display} می تواند حداکثر {$rule_value} کاراکتر باشد !", $item]);
                            break;
                            
                        case 'matches':
                            if ($value != $source[$rule_value]) {
                                $match_display = $item[$rule_value]['display'];
                                $this->addError(["رمز عبور و {$display} یکی نیستند !", $item]);
                            }
                            break;
                            
                        case 'unique':
                            $check = $this->db->query("SELECT {$item} FROM {$rule_value} WHERE {$item}=? !", [$value]);
                            if ($check->count()) 
                                $this->addError(["{$display} از قبل موجود است !", $item]);
                            break;
                             
                        case 'unique_update':
                            $t = explode(',', $rule_value);
                            $table = $t[0];
                            $id = $t[1];
                            $query = $this->db->query("SELECT * FROM {$table} WHERE id!=? AND {$item}=? !", [$id, $value]);
                            if ($query->count())
                                $this->addError(["{$display} از قبل موجود است !", $item]);
                            break;
                            
                        case 'is_numeric':
                            if (! is_numeric($value)) 
                                $this->addError(["{$display} باید عدد باشد !", $item]);
                            break;    
                            
                        case 'valid_email':
                            if (! filter_var($value, FILTER_VALIDATE_EMAIL)) 
                                $this->addError(["{$display} یک آدرس ایمیل معتبر نیست !", $item]);
                            break;

                        case 'exists':
                            $table = $rules_arr['exists']['table'];
                            $column = $rules_arr['exists']['column'];
                            $value = $rules_arr['exists']['value'];
                            if (! DB::checkExists($table, $column, $value))
                                $this->addError([" کاربری با این {$display} وجود ندارد!", $item]);
                            break;

                    }
                }
            }
        }

        if (empty($this->errors))
            $this->passed = true;
        
        return $this;
    }



    public function addError($error)
    {
        if ($error != '')
            $this->errors[] = $error;
        
        $this->passed = $this->errors ? false : true;
    }
    
    

    public function passed()
    {
        return $this->passed;
    }



    public function errors()
    {
        return $this->errors;
    }



    public function hasError($data)
    {
        if (in_array($data, $this->errors))
            return true;

        return false;
    }

        
    
    // show a list of errors (in an `ul` tag)
    public function displayErrors()
    {
        $html = '<ul class="list-unstyled p-2">';
        foreach ($this->errors as $error) {
            if (is_array($error)) {
                $html .= '<li class="text-danger">'.$error[0].'</li>';
                $html .= '<script>jQuery("document").ready(function(){jQuery("#'.$error[1].'").parent().closest("div").addClass("has-error");})</script>';
            } 
            else {
                $html .= '<li class="text-danger">'.$error.'</li>';
            }
        }
        $html .= '</ul>';
        return $html;
    }
    
    
    
}