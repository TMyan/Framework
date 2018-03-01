<?php
namespace app\controllers;

use app\fw\core\App;
use app\models\Main;


class MainController extends AppController
{

    public function indexAction() {

        $model = new Main();
        $posts = $model->findAll();
        //App::$app->cache->set('las', $posts);
        //App::$app->cache->get('las');
        $title = 'PAGE TITLE';
        $this->setVars(compact('title', 'posts'));
        $this->getView();
    }

    public function testAction() {

    }
}