<?php

declare (strict_types = 1);

namespace App\controller;

class Invoice
{
    public function index(): string
    {
        return "Invoice index";
    }

    public function create(): string
    {
        return '<form action=/invoices/create method="post"> <label>Amount</label> <input type="text" name="amount"> <input type="submit"> </form>';
    }

    public function store()
    {
        $amount = $_POST['amount'];
        var_dump($amount);
    }
}