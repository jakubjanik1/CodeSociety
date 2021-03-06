<?php

namespace Services;

use Core\{App, Session};

class AdminAuth
{
    public static function authenticate($username, $password)
    {
        $auth = App::get('config')['authentication'];

        if ($username == $auth['username'] && 
            $password == $auth['password'])
        {
            Session::set('authenticated', true);
            return true;
        }
        
        Session::set('authenticated', false);
        return false;
    }

    public static function notAuthenticated()
    {
        return Session::get('authenticated') == null;
    }
}