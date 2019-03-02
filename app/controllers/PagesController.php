<?php

namespace Controllers;

class PagesController
{
    public function index()
    {
        $message = 'Hello View!';

        return view('index', ['message' => $message]);
    }

    public function articles($category, $author, $page = 1)
    {
        echo 'Author: ' . $author . '<br>';
        echo 'Category: ' . $category . '<br>';
        echo 'Page: ' . $page . '<br>';
    }

    public function articlesByPage($page = 1)
    {
        echo 'Page: ' . $page . '<br>';
    }

    public function articlesByCategory($category, $page = 1)
    {
        echo 'Category: ' . $category . '<br>';
        echo 'Page: ' . $page . '<br>';
    }

    public function articlesByAuthor($author, $page = 1)
    {
        echo 'Author: ' . $author . '<br>';
        echo 'Page: ' . $page . '<br>';
    }
}