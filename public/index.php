<?php
declare(strict_types=1);


use App\routes\Router;

error_reporting(E_ALL);
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../infrastructure/helper.php';

$router = new Router();

$router
    ->get("/", [App\Controller\Home::class, 'index'])
    ->get("/about", [App\Controller\Home::class, 'about'])
    ->get("/invoices/create", [App\Controller\Invoice::class, 'create'])
    ->post("/invoices/create", [App\Controller\Invoice::class, 'store'])
;

echo $router->resolve($_SERVER["REQUEST_URI"], $_SERVER["REQUEST_METHOD"]);