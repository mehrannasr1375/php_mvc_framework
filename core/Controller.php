<?php
class Controller extends Application {



    public  $view;
    private $controller;
    private $action;
    // <Sample>Model  (optional)
    
    
    public function __construct($controller, $action)
    {
        parent::__construct();
        $this->controller = $controller;
        $this->action = $action;
        $this->view = new View();
    }
    
    

    protected function loadModel($model)
    {
        if (class_exists($model))
            $this->{$model.'Model'} = new $model(strtolower('tbl_'.$model));
    }
    
    
    
}