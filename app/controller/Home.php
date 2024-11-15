<?php

declare (strict_types = 1);

namespace App\controller;

class Home
{
    public function index(): string
    {
        return "Home index";
    }

    public function about(): string
    {
        return "About page";
    }


}