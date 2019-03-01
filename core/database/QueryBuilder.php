<?php

namespace Core\Database;

use PDO;

class QueryBuilder
{
    private $pdo;

    public function __construct($pdo) 
    {
        $this->pdo = $pdo;
    }

    public function selectAll($table)
    {
        $statement = $this->pdo->prepare("select * from {$table}");

        $statement->execute();
        
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }
}