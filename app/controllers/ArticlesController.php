<?php

namespace Controllers;

use Repositories\ArticlesRepository;

class ArticlesController
{
    private $repository;

    public function __construct() 
    {
        $this->repository = new ArticlesRepository();
    }

    public function articles($category, $author, $page = 1)
    {
        $articles = $this->repository->getArticles($page, $category, $author);
        $totalPages = $this->repository->getPagesCount($category, $author);
        $categories = $this->repository->getCategories();

        return view('articles', ['articles' => $articles, 'totalPages' => $totalPages, 'categories' => $categories]);
    }

    public function articlesByPage($page = 1)
    {
        $articles = $this->repository->getArticles($page);
        $totalPages = $this->repository->getPagesCount();
        $categories = $this->repository->getCategories();

        return view('articles', ['articles' => $articles, 'totalPages' => $totalPages, 'categories' => $categories]);
    }

    public function articlesByCategory($category, $page = 1)
    {
        $articles = $this->repository->getArticles($page, $category);
        $totalPages = $this->repository->getPagesCount($category);
        $categories = $this->repository->getCategories();

        return view('articles', ['articles' => $articles, 'totalPages' => $totalPages, 'categories' => $categories]);
    }

    public function articlesByAuthor($author, $page = 1)
    {
        $articles = $this->repository->getArticles($page, null, $author);
        $totalPages = $this->repository->getPagesCount(null, $author);
        $categories = $this->repository->getCategories();

        return view('articles', ['articles' => $articles, 'totalPages' => $totalPages, 'categories' => $categories]);    
    }
}