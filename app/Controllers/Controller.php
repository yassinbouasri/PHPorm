<?php

namespace App\Controllers;

abstract class Controller
{
    private const string LOCATION = ROOT_DIR . "resources/views/";

    public function render(string $view, array $params = [], bool $haveLayout = false)
    {

        extract($params);
        $viewPath = self::LOCATION . $view . ".php";
        if (!file_exists($viewPath)) {
            return;
        }

        if (!$haveLayout) {
            $blade = $this->getBlade($viewPath);
            eval("?>".$blade);
            exit();
        }

        $blade = $this->getBlade($viewPath);
        ob_start();
        $layoutPath = self::LOCATION . "layout.html";
        include $layoutPath;
        $layoutContent = ob_get_clean();

        $lines = explode("\n", $layoutContent);
        $layout = "";
        foreach ($lines as $line) {

            $layout .= str_replace("{{content}}", $blade, $line."\n");

        }

        eval("?>".$layout);
    }

    /**
     * @param string $viewPath
     * @return string
     */
    public function getBlade(string $viewPath): string
    {
        ob_start();
        include $viewPath;
        $viewContent = ob_get_clean();
        $contentLines = explode("\n", $viewContent);
        $blade = "";
        foreach ($contentLines as $line) {
            $blade .= str_replace(["{{", "}}"], ["<?php ", " ?>"], $line . "\n");
        }
        return $blade;
    }
}