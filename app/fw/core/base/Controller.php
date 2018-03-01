<?php
namespace app\fw\core\base;



abstract class Controller
{
    public $route;
    public $view;
    public $layout;
    public $vars;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = $route['action'];
    }

    public function getView(){
        $vObj = new View($this->route, $this->layout, $this->view);
        $vObj->render($this->vars);
    }

    public function setVars($vars) {
        $this->vars = $vars;
    }
}