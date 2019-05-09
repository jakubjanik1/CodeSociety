<?php

namespace Controllers;

use Services\MailSender;
use Tamtamchik\SimpleFlash\Flash;

class PagesController
{
    public function about()
    {
        return view('pages/about');
    }

    public function contact($request = null)
    {
        if ($request)
        {
            MailSender::send(['jakubjanik@vp.pl'], 
                "CodeSociety - contact from {$request->name} ({$request->email})",
                $request->message
            );

            Flash::success('Thank you for your message!');

            return redirect('contact');
        }
        else
        {
            return view('pages/contact');
        }
    }
}