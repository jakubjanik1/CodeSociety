<?php

namespace Repositories;

use Core\App;

class AccountsRepository
{
    private $accounts;

    public function __construct() 
    {
        $this->accounts = App::get('database')->table('account');
    }

    public function addAccount($account)
    {
        $account->password = hash('ripemd128', $account->password);

        $this->accounts->insert($account);
    }

    public function getAccount($account)
    {
        return $this->accounts->where('login', $account->login)
            ->where('password', $account->password)
            ->first();
    }

    public function loginExists($login)
    {
        return $this->accounts->where('login', $login)->get() != null;
    }
}