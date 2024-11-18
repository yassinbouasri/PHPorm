<?php

namespace App\Controllers;

abstract class Controller
{
    private const string LOCATION = ROOT_DIR . "resources/views/";

    public function render(string $view, array $params = [], bool $haveLayout = false): void
    {

        extract($params);
        $viewPath = self::LOCATION . $view . ".php";
        if (!$haveLayout) {
            echo $this->blade($viewPath);
            exit();
        }


        ob_start();
        $layoutPath = self::LOCATION . "layout.html";
        include $layoutPath;
        $layoutContent = ob_get_clean();

        $lines = explode("\n", $layoutContent);
        $layout = "";
        foreach ($lines as $line) {

            $layout .= str_replace("{{content}}", $this->blade($viewPath), $line);

        }
        echo $layout;

    }

    /**
     * @param string $viewPath
     * @return string
     */
    public function blade(string $viewPath): string
    {
        ob_start();
        include $viewPath;
        $viewContent = ob_get_clean();
        $contentLines = explode("\n", $viewContent);
        $blade = "";
        foreach ($contentLines as $line) {
            $blade .= str_replace(["{{", "}}"], ["<?php ", " ?>"], $line);

        }
        return $blade;
    }
}