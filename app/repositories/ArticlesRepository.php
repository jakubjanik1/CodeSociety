<?php

namespace Repositories;

use Core\App;
use Services\Newsletter;

class ArticlesRepository
{
    private $articles;
    const PAGE_SIZE = 15;

    public function __construct()
    {
        $this->articles = App::get('database')->table('article');
    }

    public function getArticle($id)
    {
        $article = $this->articles
            ->where('id', $id)
            ->first();

        return $article;
    }

    public function deleteArticle($id)
    {
        $this->articles
            ->where('id', $id)
            ->delete();
    }

    public function storeArticle($article)
    {
        $article->image = preg_replace('/data:image\/(png|jpeg|jpg);base64,/', '', $article->image);
        $article->image = base64_decode($article->image);

        if ($article->id)
        {
            $this->articles->where('id', $article->id)->update($article);
        }
        else 
        {
            $this->articles->insert($article);

            Newsletter::sendMails(Newsletter::getSubscribers(),
                "$article->title - it is our new article from category $article->category!", 
                '<h1>Welcome!!!</h1>
                Have you seen our latest article! If no as soon as possible check it and
                improve a lot your coding skill. We hope that you will enjoy it. Have a
                nice day and happy coding!'
            );
        }
    }

    public function getAllArticles()
    {
        return $this->articles->get();
    }

    public function getArticles($page, $category = null, $searchTerm = null)
    {
        $articles = $this->getFilteredArticles($category, $searchTerm);

        $articles = $articles->orderBy('date', 'desc')
            ->skip(($page - 1) * self::PAGE_SIZE)
            ->take(self::PAGE_SIZE)
            ->get();

        return $articles;
    }

    public function getPagesCount($category = null, $searchTerm = null)
    {
        $articles = $this->getFilteredArticles($category, $searchTerm);

        return ceil($articles->count() / self::PAGE_SIZE);
    }

    public function getCategories()
    {
        $articles = clone $this->articles;

        return $articles->value('category')
            ->distinct()
            ->get();
    }

    private function getFilteredArticles($category, $searchTerm = null)
    {
        $articles = clone $this->articles;

        $articles = $category ? $articles->where('category', $category) : $articles;

        $searchTerm = str_replace('_', ' ', $searchTerm);
        $articles = $searchTerm ? $articles->whereRegexp('title', "/.*{$searchTerm}.*/i") : $articles;

        return $articles;
    }
}