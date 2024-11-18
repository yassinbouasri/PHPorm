<?php

declare (strict_types = 1);

namespace App\Controllers;

class Invoice extends Controller
{
    public function index(): string
    {
        return "Invoice index";
    }

    public function create()
    {
        $var = [1,2,3,4];

        $this->render( "sampleView", ["var" => $var], "/layout.html");
    }

    public function store(): void
    {
        $amount = $_POST['amount'];
        var_dump($amount);
    }
}