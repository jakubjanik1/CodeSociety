<?php

namespace Core;

class App
{
    private static $registry = [];

    public function bind($key, $value)
    {
        self::$registry[$key] = $value;
    }

    public function get($key)
    {
        if (! array_key_exists($key, self::$registry))
        {
            throw new \Exception('That key does not exists');
        }

        return self::$registry[$key];
    }
}