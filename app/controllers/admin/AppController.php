<?php


namespace app\controllers\admin;

use app\fw\core\base\Controller;


class AppController extends Controller
{
    public $layout = 'admin';

    public function __construct($route)
    {
        parent::__construct($route);
    }
}