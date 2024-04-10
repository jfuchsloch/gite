<?php

// src/MessageHandler/ContactNotificationHandler.php
namespace App\MessageHandler;

use App\Message\ContactNotification;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Email;

use Symfony\Component\Mailer\MailerInterface;



#[AsMessageHandler]
class ContactNotificationHandler
{
    protected MailerInterface $mailer;

    public function  __construct(MailerInterface $mailer){

        $this->mailer = $mailer;
    }

    public function __invoke(ContactNotification $message)
    {
        //echo "message recu !!";

       // echo "message recu: ".$message->getContent();

        $email = (new Email())
            ->from('hello@example.com')
            ->to('you@example.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('New message received')
            ->text($message->getContent())
            ->html('<p> '.$message->getContent() .'</p>');

        $this->mailer->send($email);


        // voir un appel à une application commme mail drop ou mail trapp  (code tuto graphic art) !!!!
    }

}
