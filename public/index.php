<?php
declare(strict_types=1);

const ROOT_DIR = __DIR__ . "/../";

error_reporting(E_ALL);
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../infrastructure/helper.php';

$router = require __DIR__ . '/../app/routes/web.php';

echo $router->resolve($_SERVER["REQUEST_URI"], $_SERVER["REQUEST_METHOD"]);