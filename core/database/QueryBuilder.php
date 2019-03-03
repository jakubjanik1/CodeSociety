<?php

namespace Core\Database;

use PDO;

class QueryBuilder
{
    private $pdo;
    private $table;

    public function __construct($pdo) 
    {
        $this->pdo = $pdo;
    }

    public function table($name)
    {
        $statement = $this->pdo->prepare("select * from {$name}");

        $statement->execute();
        
        $this->table = $statement->fetchAll(PDO::FETCH_CLASS);

        return $this;
    }

    public function select(...$fields)
    {
        $this->table = array_map(function($item) use ($fields) {
            $obj = new \stdClass();
            foreach ($fields as $field) {
                if (isset($item->$field)) {
                    $obj->$field = $item->$field;
                }
            }
            return $obj;
        }, $this->table);

        return $this;
    }

    public function where($field, $value)
    {
        $this->table = array_filter($this->table, function($item) use ($field, $value) {
            return $item->$field == $value;
        });

        return $this;
    }

    public function skip($offset)
    {
        $this->table = array_slice($this->table, $offset);

        return $this;
    }

    public function take($count)
    {
        $this->table = array_slice($this->table, 0, $count);

        return $this;
    }

    public function get()
    {
        return $this->table;
    }
}