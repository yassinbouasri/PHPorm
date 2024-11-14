<?php
declare(strict_types=1);


use App\routes\Router;

error_reporting(E_ALL);
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../infrastructure/helper.php';

$router = new Router();

$router
    ->register("/", [App\Controller\Home::class, 'index'])
    ->register("/about", [App\Controller\Home::class, 'about'])
;

echo $router->resolve($_SERVER["REQUEST_URI"]);