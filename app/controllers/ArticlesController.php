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

    public function articlesByCategory($category, $page = 1)
    {
        $articles = $this->repository->getArticles($page, $category);
        $totalPages = $this->repository->getPagesCount($category);
        $categories = $this->repository->getCategories();

        return $page <= $totalPages ? 
            view('articles', ['articles' => $articles, 'totalPages' => $totalPages, 'categories' => $categories]) :
            view('error404');
    }

    public function articlesByPage($page = 1)
    {
        $articles = $this->repository->getArticles($page);
        $totalPages = $this->repository->getPagesCount();
        $categories = $this->repository->getCategories();

        return $page <= $totalPages ? 
            view('articles', ['articles' => $articles, 'totalPages' => $totalPages, 'categories' => $categories]) :
            view('error404');
    }

    public function search($searchTerm, $page = 1)
    {
        $articles = $this->repository->getArticles($page, null, $searchTerm);
        $totalPages = $this->repository->getPagesCount(null, $searchTerm);

        return $page <= $totalPages || $page == 1 ?
            view('articles', ['articles' => $articles, 'totalPages' => $totalPages, 'searchTerm' => $searchTerm]) : 
            view('error404');
    }
}