<?php

namespace Services;

use Repositories\AccountsRepository;
use Core\Session;

class AccountAuth
{
    public static function authenticate($account)
    {
        $account->password = hash('ripemd128', $account->password);

        $account = self::getAccounts()->getAccount($account);
        if ($account)
        {
            Session::set('logged_in', true);
            Session::set('account', $account);
            return true;
        }

        return false;
    }

    public static function logout()
    {
        Session::unset('logged_in');
        Session::unset('account');
    }

    private static function getAccounts()
    {
        return new AccountsRepository();
    }
}