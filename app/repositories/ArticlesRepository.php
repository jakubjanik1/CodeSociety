<?php

namespace Repositories;

use Core\App;

class ArticlesRepository
{
    private $db;
    const PAGE_SIZE = 15;

    public function __construct()
    {
        $this->db = App::get('database');
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
        $articles = $this->db->table('article');

        return $articles->value('category')
            ->distinct()
            ->get();
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