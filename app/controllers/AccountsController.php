<?php

namespace Controllers;

use Repositories\AccountsRepository;

class AccountController
{
    public function __construct()
    {
        $this->repository = new AccountsRepository();
    }
    
    public function register($account = null)
    {
        if ($account)
        {
            $this->repository->addAccount($account);
            return redirect('articles');
        }
        else
        {
            return view('account/registration');
        }
    }
}