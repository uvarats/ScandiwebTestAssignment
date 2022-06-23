<?php

use App\Container;
use App\Controllers\ProductController;
use App\Router;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

var_dump($_ENV);

$file = dirname(__DIR__) . '/.env';
if(file_exists($file)) {
    $dotenv = Dotenv::createImmutable(dirname(__DIR__));
}
$env = isset($dotenv) ? $dotenv->load() : $_ENV;
define("env", $env);

const VIEWS_PATH = __DIR__ . '/../Views';

$container = new Container();
$router = new Router($container);

$router->parseRoutes([
    ProductController::class
]);

$path = $_SERVER['PATH_INFO'] ?? '/';
$method = $_SERVER['REQUEST_METHOD'];

$router->process($path, $method);
