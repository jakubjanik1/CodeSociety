<?php

namespace Controllers;

class PagesController
{
    public function index()
    {
        $message = 'Hello View!';

        return view('index', ['message' => $message]);
    }
}