<?php

namespace Controllers;

use Repositories\ArticlesRepository;

class AdminController
{
    private $repository;

    public function __construct() 
    {
        $this->repository = new ArticlesRepository();
    }

    public function home()
    {
        return view('admin/home');
    }
}