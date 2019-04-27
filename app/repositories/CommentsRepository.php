<?php

namespace Repositories;

use Core\{App, Session};

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
            ->orderBy('written', 'desc')
            ->get();
    }

    public function storeComment($request)
    {
        $request->account_id = Session::get('account')->id;

        $this->db->table('comment')->insert($request);

        return $this->getComments($request->article_id)[0];
    }
}