<?php


namespace app\fw\core;


class Registry
{
    public static $components = [];
    private static $instance;

    private function __construct()
    {
        $config = require ROOT . '/config/config.php';
        foreach ($config['components'] as $name => $component) {
            self::$components[$name] = new $component;
        }
    }

    private function __clone()
    {
        // Not clone!!!
    }

    public static function instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __get($name) {
        if (is_object(self::$components[$name])) {
            return self::$components[$name];
        }
    }

    public function __set($name, $value)
    {
        if (! isset(self::$components[$name])) {
             self::$components[$name] = new $value;
        }
    }

    public function getList() {
        echo '<pre>';
        var_dump(self::$components);
        echo '</pre>';
    }
}