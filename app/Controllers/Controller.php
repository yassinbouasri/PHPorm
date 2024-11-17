<?php

namespace App\Controllers;

abstract class Controller
{
    private const string LOCATION = ROOT_DIR . "resources/views/";

    public function render(string $view, array $params = [], bool $haveLayout = false)
    {

        extract($params);
        $viewPath = self::LOCATION . $view . ".php";

        if (!$haveLayout) {
            ob_start();
            include $viewPath;

            echo ob_get_clean();
            exit();
        }
        ob_start();
        include $viewPath;
        $viewContent = ob_get_clean();

        ob_start();
        $layoutPath = self::LOCATION . "layout.html";
        include $layoutPath;
        $layoutContent = ob_get_clean();

        $lines = explode("\n", $layoutContent);
        $layout = "";
        foreach ($lines as $line) {

            $layout .= str_replace("{{content}}", $viewContent, $line);

        }
        echo $layout;

    }
}