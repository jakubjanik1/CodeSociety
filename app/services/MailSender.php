<?php

namespace Services;

use PHPMailer\PHPMailer\PHPMailer;

class MailSender
{
    public static function getMail()
    {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.poczta.onet.pl';
        $mail->SMTPAuth = true;
        $mail->Username = 'jakubjanik@vp.pl';
        $mail->Password = openssl_decrypt('8XPcJxMenwG29soSj8QoJw', 'aes128', 'zaq12wsx');
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465; 
        $mail->setFrom('jakubjanik@vp.pl', 'CodeSociety');

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