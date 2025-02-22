<?php

use App\routes\Router;

$router = new Router();
return $router
    ->get("/", [App\Controllers\Home::class, 'index'])
    ->get("/about", [App\Controllers\Home::class, 'about'])
    ->get("/invoices/create", [App\Controllers\Invoice::class, 'create'])
    ->post("/invoices/create", [App\Controllers\Invoice::class, 'store'])
;
