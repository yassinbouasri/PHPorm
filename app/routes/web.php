<?php

use App\routes\Router;

$router = new Router();
return $router
    ->get("/", [App\Controller\Home::class, 'index'])
    ->get("/about", [App\Controller\Home::class, 'about'])
    ->get("/invoices/create", [App\Controller\Invoice::class, 'create'])
    ->post("/invoices/create", [App\Controller\Invoice::class, 'store'])
;
