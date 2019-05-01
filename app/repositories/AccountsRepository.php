<?php

namespace Repositories;

use Core\App;
use Tamtamchik\SimpleFlash\Flash;

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

        $result = $this->accounts->insert($account);

        if ($result)
        {
            Flash::success('Account registered successfully!');
        }
        else
        {
            Flash::error('Sorry, registration failed!');
        }
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