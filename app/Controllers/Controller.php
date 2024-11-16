<?php

namespace App\Controllers;

abstract class Controller
{
    private const string LOCATION = ROOT_DIR . "resources/views/";

    public function render(string $view, array $params = []): void
    {
        extract($params);
        require_once self::LOCATION . $view . ".weave.html";
    }
}