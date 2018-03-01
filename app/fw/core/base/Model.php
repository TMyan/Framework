<?php

namespace app\fw\core\base;

use app\fw\core\Db;
use Valitron\Validator;


abstract class Model
{
    protected $pdo;
    protected $table;
    protected $pk;
    public $attributes = [];
    public $errors = [];
    public $rules = [];

    public function __construct()
    {
        $this->pdo =  Db::instance();
        $this->pk = 'id';
    }

    public function load($data) {
        foreach ($this->attributes as $name => $value) {
            if (isset($data[$name])) {
                $this->attributes[$name] = $data[$name];
            }
        }
    }

    public function validate($data) {
        $v = new Validator($data);
        $v->rules($this->rules);
        if ($v->validate()) {
            return true;
        }
        $this->errors = $v->errors();
        return false;
    }

    public function query($sql) {
        return $this->pdo->execute($sql);
    }

    public function findAll() {
        $sql = "SELECT * FROM {$this->table}";
        return $this->pdo->query($sql);
    }

    public function findOne($id, $field = '') {
        $field = $field ?: $this->pk;
        $sql = "SELECT * FROM {$this->table} WHERE {$field} = ? LIMIT 1";

        return $this->pdo->query($sql, [$id]);
    }

    public function findBySql($sql, $params = []) {
        return $this->pdo->query($sql, $params);
    }


    public function findLike($str, $field, $table = '') {
        $table = $table ?: $this->table;
        $sql = "SELECT * FROM {$table} WHERE {$field} LIKE ?";
        return $this->pdo->query($sql, ['%' . $str . '%']);
    }



}