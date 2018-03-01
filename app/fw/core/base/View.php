<?php
namespace app\fw\core\base;


class View
{
    public $route = [];
    public $view;
    public $layout;

    public function __construct($route, $layout = '', $view = '')
    {
        $this->route = $route;
        $this->view = $view;
        if ($layout === false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ?: LAYOUT;
        }
    }

    public function render($vars) {

        if (is_array($vars)) {
            extract($vars);
        }

        $file_view = str_replace('\\', '/', APP . "/views/{$this->route['prefix']}{$this->route['controller']}/{$this->view}.php");
        ob_start();
        if (file_exists($file_view)) {
            require $file_view;
        } else {
            throw new \Exception("<p>View <b>|{$file_view}| not found.</b></p>", 404);
        }

        $content = ob_get_clean();
        if (false !== $this->layout) {
            $file_layout = APP . "/views/layouts/{$this->layout}.php";
            if (is_file($file_layout)) {
                require $file_layout;
            } else {
                throw new \Exception("<p>Layout <b>|{$file_layout}| not found.</b></p>", 404);
            }
        }

    }

}