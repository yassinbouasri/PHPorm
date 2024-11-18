<?php

declare(strict_types=1);

namespace App\Controllers;

abstract class Controller
{
    private const string LOCATION = ROOT_DIR . "resources/views/";

    public function render(string $view, array $params = [], ?string $layoutPath = ""): void
    {

        extract($params);
        $viewPath = self::LOCATION . $view . ".php";
        if (!file_exists($viewPath)) {
            return;
        }

        if (!empty($layoutPath)) {
            $blade = $this->getBlade($viewPath);
            eval("?>".$blade);
            exit();
        }

        if (!file_exists($layoutPath)) {
            return;
        }
        $blade = $this->getBlade($viewPath);
        ob_start();
        $layoutPath = self::LOCATION . $layoutPath;
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
    private function getBlade(string $viewPath): string
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