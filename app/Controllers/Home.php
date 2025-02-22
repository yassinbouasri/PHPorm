<?php

declare (strict_types = 1);

namespace App\Controllers;

class Home extends Controller
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