<?php

namespace Controllers;

use Repositories\CommentsRepository;

class CommentsController
{
    private $repository;

    public function __construct() 
    {
        $this->repository = new CommentsRepository();
    }

    public function comments($articleId)
    {
        $comments = $this->repository->getComments($articleId);

        return json($comments);
    }   

    public function storeComment($request)
    {
        $comment = $this->repository->storeComment($request);

        return json($comment);
    }
}