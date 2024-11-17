<?php

namespace App\Controllers;

abstract class Controller
{
    private const string LOCATION = ROOT_DIR . "resources/views/";

    public function render(string $view, array $params = [], bool $haveLayout = false): void
    {
        extract($params);

        if (!$haveLayout) {
            require_once self::LOCATION . $view . ".weave.html";
        }

        if ($haveLayout) {
            $content = file_get_contents(self::LOCATION . $view . ".weave.html");
            $layout = file_get_contents(self::LOCATION . "layout.html");
            $lines = explode("\n", $layout);
            foreach ($lines as $key => $value) {

                $layout = str_replace("{{content}}", $content, $layout);

            }
            echo $layout;
        }

    }
}