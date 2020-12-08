<?php

$baseDir = dirname(__DIR__) . DIRECTORY_SEPARATOR;
$appDir = $baseDir . 'app' . DIRECTORY_SEPARATOR;
$viewsDir = $appDir . 'Views' . DIRECTORY_SEPARATOR;
$publicDir = $baseDir . 'public' . DIRECTORY_SEPARATOR;

require $baseDir . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$controllersNamespace = 'App\\Controllers\\';
$modelsNamespace = 'App\\Models\\';

$routes = [
    'get:/tasks' => ['controller' => 'TaskController', 'method' => 'index'],
    'get:/tasks/create' => ['controller' => 'TaskController', 'method' => 'create'],
    'get:/tasks/show' => ['controller' => 'TaskController', 'method' => 'show'],
    'post:/tasks/store' => ['controller' => 'TaskController', 'method' => 'store'],
    'get:/tasks/delete' => ['controller' => 'TaskController', 'method' => 'delete'],
    'get:/tasks/edit' => ['controller' => 'TaskController', 'method' => 'edit'],
    'post:/tasks/update' => ['controller' => 'TaskController', 'method' => 'update'],
    'get:/auth' => ['controller' => 'AuthController', 'method' => 'loginView'],
    'post:/auth' => ['controller' => 'AuthController', 'method' => 'login'],
    'get:/auth/logout' => ['controller' => 'AuthController', 'method' => 'logout'],
];
session_start();

$route = strtolower($_SERVER['REQUEST_METHOD']) . ':' . $_REQUEST['route'];

$controllerName = $controllersNamespace . $routes[$route]['controller'];
$method = $routes[$route]['method'];

if ($_SERVER['REQUEST_URI'] === '/') {
    $controllerName = $controllersNamespace . 'TaskController';
    $method = 'index';
}

if (method_exists($controllerName, $method)) {
    $controller = new $controllerName();
    $response = $controller->$method();

    if (isset($response['view'])) {
        $view = $viewsDir . $response['view'];

        if (isset($response['data'])) {
            extract($response['data']);
        }

        include $view;
    } elseif (isset($response['data'])) {
        var_dump($response['data']);
    }
} else {
    header('HTTP/1.1 404 Not Found');
    echo '404 - Not Found';
}
