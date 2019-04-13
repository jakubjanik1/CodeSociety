<?php

namespace Controllers;

use Repositories\ArticlesRepository;
use Controllers\Helpers\AdminAuth;

class AdminController
{
    private $repository;

    public function __construct() 
    {
        $this->repository = new ArticlesRepository();
    }

    public function __call($method, $arguments)
    {
        if (AdminAuth::notAuthenticated())
        {
            return redirect('admin/authenticate');
        }
        else
        {
            $this->$method(...$arguments);
        }
    }

    public function authenticate($user = null)
    {
        if ($user)
        {
            if (AdminAuth::authenticate($user->name, $user->password)) 
            {
                return redirect('admin');
            } 
            else 
            {
                return view('admin/authentication', ['error' => 'Incorrect username or password!']);
            }
        }
        else
        {
            return view('admin/authentication');
        }
    }

    protected function home()
    {
        return view('admin/home');
    }

    protected function article($id = null)
    {
        $article = $this->repository->getArticle($id);

        return view('admin/article', ['article' => $article]);
    }

    protected function storeArticle($article)
    {
        $this->repository->storeArticle($article);

        return redirect('admin/articles');
    }

    protected function articles()
    {
        $articles = $this->repository->getAllArticles();

        return view('admin/articles', ['articles' => $articles]);
    }

    protected function deleteArticle($id)
    {
        $this->repository->deleteArticle($id);

        return redirect('admin/articles');
    }
}