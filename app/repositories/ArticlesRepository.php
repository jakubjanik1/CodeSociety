<?php

namespace Repositories;

use Core\App;

class ArticlesRepository
{
    private $db;
    const PAGE_SIZE = 1;

    public function __construct()
    {
        $this->db = App::get('database');
    }

    public function getArticles($page, $category = null)
    {
        $articles = $this->getFilteredArticles($category);

        $articles = $articles->orderBy('date', 'desc')
            ->skip(($page - 1) * self::PAGE_SIZE)
            ->take(self::PAGE_SIZE)
            ->get();

        return $articles;
    }

    public function getPagesCount($category = null)
    {
        $articles = $this->getFilteredArticles($category);

        return ceil($articles->count() / self::PAGE_SIZE);
    }

    public function getCategories()
    {
        $articles = $this->db->table('article');

        return $articles->value('category')
            ->distinct()
            ->get();
    }

    private function getFilteredArticles($category)
    {
        $articles = $this->db->table('article');

        $articles = $category ? $articles->where('category', $category) : $articles;

        return $articles;
    }
}