<?php

namespace Core\Database;

use PDO;

class QueryBuilder
{
    private $pdo;
    private $table;
    private $tableName;

    public function __construct($pdo) 
    {
        $this->pdo = $pdo;
    }

    public function table($name)
    {
        $this->tableName = $name;

        $statement = $this->pdo->prepare("select * from `{$name}`");

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

    public function value($field)
    {
        $this->table = array_column($this->table, $field);

        return $this;
    }

    public function where($field, $value)
    {
        $this->table = array_filter($this->table, function($item) use ($field, $value) {
            return $item->$field == $value;
        });

        return $this;
    }

    public function whereRegexp($field, $pattern)
    {
        $this->table = array_filter($this->table, function($item) use ($field, $pattern) {
            return preg_match($pattern, $item->$field);
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

    public function count()
    {
        return count($this->table);
    }

    public function orderBy($field, $direction)
    {
        usort($this->table, function($x, $y) use ($field, $direction) {
            return $direction == 'asc' ? 
                $x->$field > $y->$field : 
                $x->$field < $y->$field;
        });

        return $this;
    }

    public function distinct()
    {
        $this->table = array_unique($this->table, SORT_REGULAR);

        return $this;
    }

    public function get()
    {
        return $this->table;
    }

    public function first()
    {
        $this->table = array_values($this->table);
        return $this->table[0] ?? null;
    }

    public function delete()
    {
        foreach ($this->table as $item)
        {
            $statement = $this->pdo->prepare("delete from `{$this->tableName}` where id = :id");

            $statement->execute(['id' => $item->id]);
        }
    }

    public function insert($parameters)
    {
        $parameters = (array)$parameters;

        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            "`{$this->tableName}`",
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        $statement = $this->pdo->prepare($sql);
        $statement->execute($parameters);
    }

    public function update($parameters)
    {
        $parameters = (array)$parameters;
        $parameters = array_key_exists('id', $parameters) ? array_slice($parameters, 1) : $parameters;
        
        foreach ($this->table as $item)
        {
            $bindList = array_map(function ($key) {
                return "{$key} = :{$key}";
            }, array_keys($parameters));

            $sql = sprintf(
                'update %s set %s where id = %s',
                "`{$this->tableName}`",
                implode(', ', $bindList),
                $item->id
            );

            $statement = $this->pdo->prepare($sql);
            $statement->execute($parameters);
        } 
    }

    public function join($table, $field1, $field2)
    {
        $table = $this->pdo->query("select * from {$table}")->fetchAll(PDO::FETCH_CLASS);

        $out = [];
        foreach ($this->table as $row1)
        {
            foreach ($table as $row2) 
            {
                if ($row1->$field1 == $row2->$field2)
                {
                    $out[] = (object) array_merge((array) $row1, (array) $row2);
                }
            }
        }
        
        $this->table = $out;
        return $this;
    }
}