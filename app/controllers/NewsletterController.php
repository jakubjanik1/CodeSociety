<?php

namespace Controllers;

use Services\Newsletter;

class NewsletterController
{
    public function subscribe($request)
    {
        if (! Newsletter::isSubscribed($request->email))
        {
            Newsletter::subscribe($request->email);

            Newsletter::sendMails([$request->email], 
                'You have become CodeSociety subscriber!', 
                '<h1>Welcome!!!</h1>
                Thank you for sign up to our mailing list. You will be 
                up-to-date with our updates. If we post new article, you
                will be know about it in a flash. Have a nice day and happy coding!'
            );
        }
    }   
}