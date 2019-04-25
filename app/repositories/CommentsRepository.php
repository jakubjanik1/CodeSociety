<?php

namespace Repositories;

use Core\App;

class CommentsRepository
{
    private $db;

    public function __construct()
    {
        $this->db = App::get('database');
    }

    public function getComments($articleId)
    {
        return $this->db->table('comment')
            ->where('article_id', $articleId)
            ->join('account', 'account_id', 'id')
            ->select('content', 'written', 'login', 'image')
            ->get();
    }
}