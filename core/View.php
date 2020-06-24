<?php
class View extends Controller {



    protected $head;
    protected $body;
    protected $site_title = SITE_TITLE;
    protected $output_buffer;
    protected $layout = DEFAULT_LAYOUT;
    public    $displayErrors = null; // a list of view errors (ul)
    public    $post = null; // an array of posted variable with POST method


    public function __construct() {}



    // takes the view (.php file) && returns it with specified layout on layout attribute
    public function render($view_name)
    {
        $view_arr = explode('/', $view_name);
        $view_str = implode(DS, $view_arr);
        
        if (file_exists(ROOT . DS . 'app' . DS . 'views' . DS . $view_str . '.php')) {
            include(ROOT . DS . 'app' . DS . 'views' . DS . $view_str . '.php');
            include(ROOT . DS . 'app' . DS . 'views' . DS . 'layouts' . DS . $this->layout . '.php');
        } else
            die("view '" . $view_name . "' not exists!");
    }
    


    // return head or body
    public function content($type) 
    {
        if ($type == 'head')
            return $this->head;
        else if ($type == 'body')
            return $this->body;
        else
            return false;       
    }


    
    public function start($type) 
    {
        $this->output_buffer = $type;

        ob_start();   
    }


    
    public function end()
    {
        if ($this->output_buffer == 'head')
            $this->head = ob_get_clean(); 
        else if ($this->output_buffer == 'body')
            $this->body = ob_get_clean();
        else
            die("the start method does not started yet!");
    }
    


    public function setSiteTitle($title) 
    {
        $this->site_title = $title;   
    }


    
    public function getSiteTitle() 
    {
        return $this->site_title;
    }


    
    // set layout file for render
    public function setLayout($layout_path) 
    {
        $this->layout = $layout_path;   
    }



    public function insert($path)
    {
        include ROOT . DS . 'app' . DS . 'views' . DS . $path . '.php' ;
    }



    public function partial($group, $partial)
    {
        include ROOT . DS . 'app' . DS . 'views' . DS . $group . DS . 'partials' . DS . $partial . '.php' ;
    }



}