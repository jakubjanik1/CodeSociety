<?php

namespace Controllers;

use Repositories\ArticlesRepository;
use Services\AdminAuth;
use Services\Analytics;

class AdminController
{
    private $repository;
    private $analytics;

    public function __construct() 
    {
        $this->repository = new ArticlesRepository();
        $this->analytics = new Analytics();
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
        $visits = $this->analytics->getVisitsFromToday();
        $newAccounts = $this->analytics->getNewAccountsFromToday();
        $newComments = $this->analytics->getNewCommentsFromToday();
        $newArticles = $this->analytics->getNewArticlesFromToday();
        $visitsChart = $this->analytics->getVisitsChartFromLastWeek();
        $browserChart = $this->analytics->getBrowsersChart();
        $visitsMap = $this->analytics->getVisitsMap();
    
        return view('admin/home', ['visits' => $visits, 
            'newAccounts' => $newAccounts, 
            'newComments' => $newComments, 
            'newArticles' => $newArticles,
            'visitsChart' => $visitsChart,
            'browsersChart' => $browserChart,
            'visitsMap' => $visitsMap
        ]);
    }

    protected function editArticle($slug = null)
    {
        $article = $this->repository->getArticle($slug);

        return $article ? 
            view('admin/article', ['article' => $article]) :
            view('error404');
    }

    protected function addArticle()
    {
        return view('admin/article', ['article' => null]);
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