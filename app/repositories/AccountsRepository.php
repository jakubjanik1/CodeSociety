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
        $account->image = preg_replace('/data:image\/(png|jpeg|jpg);base64,/', '', $account->image);
        $account->image = base64_decode($account->image);

        $account->password = hash('ripemd128', $account->password);

        $this->accounts->insert($account);
    }
}