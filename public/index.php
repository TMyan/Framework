<?php

use app\fw\core\Router;
use app\fw\core\App;

$query = rtrim($_SERVER['REQUEST_URI'], '/') ;
$query = substr($query, 1);

define('WWW', __DIR__); // Path to the public folder.
define('CORE', dirname(__DIR__) . '/app/fw/core');
define('ROOT', dirname(__DIR__));
define('LIBS', dirname(__DIR__) . '/app/fw/libs');
define('APP', dirname(__DIR__) . '/app');
define('CACHE', dirname(__DIR__) . '/tmp/cache');
define('LAYOUT', 'default');
define("DEBUG", 1);


require '../app/fw/libs/functions.php';
require '../vendor/autoload.php';

/*
 * This is our autoloader
    spl_autoload_register(function ($className) {
        $file = ROOT . '/' . str_replace('\\', '/', $className) . '.php';
        if (is_file($file)) {
            require_once  $file;
        }
    });
*/

new App();

Router::add('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$',['controller' => 'Page']);
Router::add('^page/(?P<alias>[a-z-]+)$',['controller' => 'Page', 'action' => 'view']);

//default routes
Router::add('^admin$', ['controller' => 'User', 'action' => 'index', 'prefix' => 'admin']);
Router::add('^admin/(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix' => 'admin']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);



Router::dispatch($query);

