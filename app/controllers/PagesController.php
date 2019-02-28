<?php

namespace Controllers;

require 'core/helpers.php';

class PagesController
{
    public function index()
    {
        $message = 'Hello View!';

        return view('index', ['message' => $message]);
    }
}