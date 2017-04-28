<?php

namespace AppBundle\Service\Notification;

class EmailNotificationService
{

    public function sendEmail($title, $text) {

        if (empty($title) || empty($text)) {
            return false;
        }

        //Logica de envio de email

        return "E-mail enviado com sucesso";
    }

}