<?php
class HomeController extends Controller {

    // public $view;



    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->view->setLayout('default');
    }



    public function index()
    {
        $this->view->render('home/index');
    }



}
