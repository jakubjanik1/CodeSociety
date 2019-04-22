<?php

namespace Controllers;

use Repositories\AccountsRepository;
use Services\AccountAuth;

class AccountsController
{
    private $repository;

    public function __construct()
    {
        $this->repository = new AccountsRepository();
    }
    
    public function register($account = null)
    {
        if ($account)
        {
            $this->repository->addAccount($account);
            return redirect('account/login');
        }
        else
        {
            return view('account/registration');
        }
    }

    public function login($account = null)
    {
        if ($account)
        {
            if (AccountAuth::authenticate($account))
            {
                return redirect('articles');
            }
            else
            {
                return view('account/login', ['error' => 'Incorrect login or password!']);
            }
        }
        else
        {
            return view('account/login');
        }
    }

    public function logout()
    {
        AccountAuth::logout();
        return redirectBack();
    }

    public function loginExists($request)
    {
        echo $this->repository->loginExists($request->login);
    }
}