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

    public function article($id = null)
    {
        $article = $this->repository->getArticle($id);

        return view('admin/article', ['article' => $article]);
    }

    public function storeArticle($article)
    {
        $this->repository->storeArticle($article);

        return redirect('admin/articles');
    }

    public function articles()
    {
        $articles = $this->repository->getAllArticles();

        return view('admin/articles', ['articles' => $articles]);
    }

    public function deleteArticle($id)
    {
        $this->repository->deleteArticle($id);

        return redirect('admin/articles');
    }
}