<?php

namespace Services;

use PHPMailer\PHPMailer\PHPMailer;
use Core\App;

class MailSender
{
    public static function getMail()
    {
        ['name' => $name, 'password' => $password, 'host' => $host] = App::get('config')['email'];

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = $host;
        $mail->SMTPAuth = true;
        $mail->Username = $name;
        $mail->Password = $password;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465; 
        $mail->setFrom($name, 'CodeSociety');

        return $mail;
    }

    public static function send($adresses, $subject, $body)
    {
        if (! $adresses) return;

        $mail = self::getMail();
        foreach ($adresses as $address) 
        {
            $mail->addAddress($address);
        }

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
    }
}