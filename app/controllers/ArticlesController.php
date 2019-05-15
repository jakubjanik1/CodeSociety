<?php

namespace Controllers;

use Repositories\ArticlesRepository;
use Core\Session;

class ArticlesController
{
    private $repository;

    public function __construct() 
    {
        $this->repository = new ArticlesRepository();
    }

    public function article($slug)
    {
        $article = $this->repository->getArticle($slug);
        $accountLikes = $this->repository->getAccountLikes();

        return $article ? 
            view('article', ['article' => $article, 'accountLikes' => $accountLikes]) : 
            view('error404');
    }

    public function articlesByCategory($category, $page = 1)
    {
        $articles = $this->repository->getArticles($page, $category);
        $totalPages = $this->repository->getPagesCount($category);
        $categories = $this->repository->getCategories();
        $accountLikes = $this->repository->getAccountLikes();

        return $page <= $totalPages ? 
            view('articles', ['articles' => $articles, 'totalPages' => $totalPages, 'categories' => $categories, 'accountLikes' => $accountLikes]) :
            view('error404');
    }

    public function articlesByPage($page = 1)
    {
        $articles = $this->repository->getArticles($page);
        $totalPages = $this->repository->getPagesCount();
        $categories = $this->repository->getCategories();
        $accountLikes = $this->repository->getAccountLikes();

        return $page <= $totalPages ? 
            view('articles', ['articles' => $articles, 'totalPages' => $totalPages, 'categories' => $categories, 'accountLikes' => $accountLikes]) :
            view('error404');
    }

    public function search($searchTerm, $page = 1)
    {
        $articles = $this->repository->getArticles($page, null, $searchTerm);
        $totalPages = $this->repository->getPagesCount(null, $searchTerm);
        $accountLikes = $this->repository->getAccountLikes();

        return $page <= $totalPages || $page == 1 ?
            view('articles', ['articles' => $articles, 'totalPages' => $totalPages, 'searchTerm' => $searchTerm, 'accountLikes' => $accountLikes]) : 
            view('error404');
    }

    public function likeArticle($articleId)
    {
        if (! Session::get('logged_in')) return;

        $accountId = Session::get('account')->id;
        if ($this->repository->articleIsLiked($articleId, $accountId))
        {
            $this->repository->removeLike($articleId, $accountId);
            echo true;
        }
        else
        {
            $this->repository->addLike($articleId, $accountId);
            echo false;
        }
    }
}