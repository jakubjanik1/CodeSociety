<?php

namespace Repositories;

use Core\App;
use Tamtamchik\SimpleFlash\Flash;

class AccountsRepository
{
    private $db;

    public function __construct() 
    {
        $this->db = App::get('database');
    }

    public function addAccount($account)
    {
        $account->password = hash('ripemd128', $account->password);

        $result = $this->db->table('account')->insert($account);

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
        return $this->db->table('account')
            ->where('login', $account->login)
            ->where('password', $account->password)
            ->first();
    }

    public function getAccountByLogin($login)
    {
        return $this->db->table('account')
            ->where('login', $login)
            ->first();
    }

    public function loginExists($login)
    {
        return $this->accounts->where('login', $login)->get() != null;
    }
}