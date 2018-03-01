<?php

namespace app\models;

use app\fw\core\base\Model;


class Main extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'posts';

    }


}