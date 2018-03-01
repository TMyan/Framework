<?php


namespace app\models;


use app\fw\core\base\Model;

class User extends Model
{
    public $attributes = [
        'login' => '',
        'password' => '',
        'name' => '',
        'email' => ''
    ];

    public $rules = [
        'required' => [
         ['login'],
         ['password'],
         ['email'],
         ['name']
        ],
        'email' => [
            ['email']
        ],
        'lengthMin' => [
            ['password', 6]
        ]
    ];
}