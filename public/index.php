<?php

$baseUrl = dirname($_SERVER['SCRIPT_NAME']);
if ($baseUrl[strlen($baseUrl) - 1] !== '/') $baseUrl .= '/';

$baseDir = dirname(__DIR__) . DIRECTORY_SEPARATOR;
$appDir = $baseDir . 'app' . DIRECTORY_SEPARATOR;
$viewsDir = $appDir . 'Views' . DIRECTORY_SEPARATOR;
$publicDir = $baseDir . 'public' . DIRECTORY_SEPARATOR;

$config = parse_ini_file($baseDir . 'config.ini', true);

require $baseDir . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$controllersNamespace = 'App\\Controllers\\';
$modelsNamespace = 'App\\Models\\';

function addMessage(string $group, string $message) {
    $_SESSION[$group][] = htmlspecialchars($message);
}

function getMessages(string $group) {
    $messages = $_SESSION[$group] ?? [];
    unset($_SESSION[$group]);

    return $messages;
}

function prepareUrl(string $url)
{
    global $baseUrl;
    $newUrl = $baseUrl . ltrim($url, '/');
    return $newUrl;
}

function redirect(string $url)
{
    header('Location: ' . $url);
    exit();
}

$routes = [
    'get:/' => ['controller' => 'TaskController', 'method' => 'index'],
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

$requestMethod = strtolower($_SERVER['REQUEST_METHOD']);
$requestRoute = substr((isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $baseUrl . 'tasks'), strlen($baseUrl) - 1);
$requestRoute = substr($requestRoute, 0, strpos($requestRoute, '?') !==  false ? strpos($requestRoute, '?') : strlen($requestRoute));
$route =  $requestMethod . ':/' . ($requestRoute !== '/' ? $requestRoute : '/tasks');

$controllerName = $controllersNamespace . $routes[$route]['controller'];
$method = $routes[$route]['method'];

if (method_exists($controllerName, $method)) {
    $controller = new $controllerName();
    $response = $controller->$method();

    if (isset($response['view'])) {
        $layout = $viewsDir . 'layouts/app.php';
        $view = $viewsDir . $response['view'];

        if (isset($response['data'])) {

            extract($response['data']);
        }

        $successes = getMessages('successes');
        $infos = getMessages('infos');
        $errors = getMessages('errors');

        include $layout;
    } elseif (isset($response['data'])) {
        var_dump($response['data']);
    }
} else {
    header('HTTP/1.1 404 Not Found');
    echo '404 - Not Found';
}
