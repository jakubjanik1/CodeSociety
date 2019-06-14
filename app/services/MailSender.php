<?php

namespace Services;

use SendGrid\Mail\Mail as EmailMessage;
use Core\App;

class MailSender
{
    public static function getMail()
    {
        $apiKey = App::get('config')['email']['api_key'];
        
        return new \SendGrid($apiKey);
    }

    public static function send($adresses, $subject, $body)
    {
        if (! $adresses) return;

        ['name' => $name] = App::get('config')['email'];

        $message = new EmailMessage();
        $message->setFrom($name, 'CodeSociety');
        $message->setSubject($subject);
        $message->addContent('text/html', $body);

        foreach ($adresses as $address) {
            $message->addTo($address);
        }

        self::getMail()->send($message);
    }
}