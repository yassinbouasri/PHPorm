<?php

namespace App\Controllers;

abstract class Controller
{
    private const string LOCATION = ROOT_DIR . "resources/views/";

    public function render(string $view, array $params = [], bool $haveLayout = false )
    {
        $layout = "";
        $content = file_get_contents( self::LOCATION . $view . ".weave.html");

        extract($params);

        if ($haveLayout) {
            $layout = file_get_contents(self::LOCATION . "layout.html");
            $lines = explode("\n", $layout);
            foreach ($lines as $key => $value) {

                $layout = str_replace("{{content}}", $content , $layout);


            }

        }

        echo $layout;
    }
}