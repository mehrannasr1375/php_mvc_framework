<?php
class RestrictedController extends Controller {

    // public $view;



    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }



    public function index()
    {
        $this->view->render('restricted/index');
    }



}
