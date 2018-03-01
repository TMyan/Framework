<?php


namespace app\controllers;


use app\models\User;

class UserController extends AppController
{
    public function signupAction() {
        if (! empty($_POST)) {
            $user = new User();
            $data = $_POST;
            $user->load($data);
            if ($user->validate($data)) {
                echo 'ok';
            } else {
                echo 'no';
            }
            die();
        }
        $this->getView();
    }

    public function loginAction() {
        $this->getView();
    }

    public function logoutAction() {
        $this->getView();
    }
}