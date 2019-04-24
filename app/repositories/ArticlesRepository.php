<?php

namespace Repositories;

use Core\App;
use Services\Newsletter;
use Core\Session;

class ArticlesRepository
{
    private $db;
    const PAGE_SIZE = 15;

    public function __construct()
    {
        $this->db = App::get('database');
    }

    public function getArticle($id)
    {
        $article = $this->db->table('article')
            ->where('id', $id)
            ->first();

        return $article;
    }

    public function deleteArticle($id)
    {
        $this->db->table('article')
            ->where('id', $id)
            ->delete();
    }

    public function storeArticle($article)
    {
        if ($article->id)
        {
            $this->db->table('article')->where('id', $article->id)->update($article);
        }
        else 
        {
            $this->db->table('article')->insert($article);

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
        return $this->db->table('article')->get();
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
        return $this->db->table('article')->value('category')
            ->distinct()
            ->get();
    }

    public function articleIsLiked($articleId, $accountId)
    {
        return $this->db->table('like')
            ->where('article_id', $articleId)
            ->where('account_id', $accountId)
            ->get() != null;
    }

    public function addLike($articleId, $accountId)
    {
        $this->db->table('like')
            ->insert(['article_id' => $articleId, 'account_id' => $accountId]);

        $likes = $this->db->table('like')
            ->where('article_id', $articleId)
            ->count();

        $this->db->table('article')
            ->where('id', $articleId)
            ->update(['likes' => $likes]);
    }

    public function removeLike($articleId, $accountId)
    {
        $this->db->table('like')
            ->where('article_id', $articleId)
            ->where('account_id', $accountId)
            ->delete();

        $likes = $this->db->table('like')
            ->where('article_id', $articleId)
            ->count(); 

        $this->db->table('article')
            ->where('id', $articleId)
            ->update(['likes' => $likes]);
    }

    public function getAccountLikes()
    {
        if (! Session::get('logged_in')) return [];

        $accountId = Session::get('account')->id;

        $result = $this->db->table('like')
            ->where('account_id', $accountId)
            ->select('article_id')
            ->get();

        return array_column($result, 'article_id');
    }

    private function getFilteredArticles($category, $searchTerm = null)
    {
        $articles = $this->db->table('article');

        $articles = $category ? $articles->where('category', $category) : $articles;

        $searchTerm = str_replace('_', ' ', $searchTerm);
        $articles = $searchTerm ? $articles->whereRegexp('title', "/.*{$searchTerm}.*/i") : $articles;

        return $articles;
    }
}