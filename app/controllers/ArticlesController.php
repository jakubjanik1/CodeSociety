<?php

namespace Controllers;

use Core\App;

class ArticlesController
{
    private $db;
    const PAGE_SIZE = 3;

    public function __construct()
    {
        $this->db = App::get('database');
    }

    public function articles($category, $author, $page = 1)
    {
        $articles = $this->db->table('article')
            ->where('category', $category)
            ->where('author', $author)
            ->orderBy('date', 'desc')
            ->skip(($page - 1) * self::PAGE_SIZE)
            ->take(self::PAGE_SIZE)
            ->get();

        $count = $this->db->table('article')->where('category', $category)->where('author', $author)->count();
        $totalPages = ceil($count / self::PAGE_SIZE);

        return view('articles', ['articles' => $articles, 'totalPages' => $totalPages]);
    }

    public function articlesByPage($page = 1)
    {
        $articles = $this->db->table('article')
            ->orderBy('date', 'desc')
            ->skip(($page - 1) * self::PAGE_SIZE)
            ->take(self::PAGE_SIZE)
            ->get();

        $count = $this->db->table('article')->count();
        $totalPages = ceil($count / self::PAGE_SIZE);

        return view('articles', ['articles' => $articles, 'totalPages' => $totalPages]);
    }

    public function articlesByCategory($category, $page = 1)
    {
        $articles = $this->db->table('article')
            ->where('category', $category)
            ->orderBy('date', 'desc')
            ->skip(($page - 1) * self::PAGE_SIZE)
            ->take(self::PAGE_SIZE)
            ->get();

        $count = $this->db->table('article')->where('category', $category)->count();
        $totalPages = ceil($count / self::PAGE_SIZE);

        return view('articles', ['articles' => $articles, 'totalPages' => $totalPages]);
    }

    public function articlesByAuthor($author, $page = 1)
    {
        $articles = $this->db->table('article')
            ->where('author', $author)
            ->orderBy('date', 'desc')
            ->skip(($page - 1) * self::PAGE_SIZE)
            ->take(self::PAGE_SIZE)
            ->get();

        $count = $this->db->table('article')->where('author', $author)->count();
        $totalPages = ceil($count / self::PAGE_SIZE);

        return view('articles', ['articles' => $articles, 'totalPages' => $totalPages]);
    }
}