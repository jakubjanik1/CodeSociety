<?php

namespace Core;

class App
{
    private static $registry = [];

    public static function bind($key, $value)
    {
        self::$registry[$key] = $value;
    }

    public static function get($key)
    {
        if (! array_key_exists($key, self::$registry))
        {
            throw new \Exception('That key does not exists');
        }

        return self::$registry[$key];
    }
}