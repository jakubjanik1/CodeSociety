<?php

namespace Services;

use Core\App;

class Newsletter
{
    public static function subscribe($email)
    {
        self::subscribers()->insert(['email' => $email]);
    }

    public static function isSubscribed($email)
    {
        return self::subscribers()->where('email', $email)->get() != null;
    }

    public static function getSubscribers()
    {
        return self::subscribers()->value('email')->get();
    }

    public static function sendMails($addresses, $subject, $body)
    {
        MailSender::send($addresses, $subject, $body);
    }

    private static function subscribers()
    {
        return App::get('database')->table('newsletter');
    }
}