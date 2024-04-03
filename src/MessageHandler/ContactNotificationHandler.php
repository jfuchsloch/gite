<?php

// src/MessageHandler/ContactNotificationHandler.php
namespace App\MessageHandler;

use App\Message\ContactNotification;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class ContactNotificationHandler
{
    public function __invoke(ContactNotification $message)
    {
        //echo "message recu !!";

        echo "message recu: ".$message->getContent();

        // voir un appel à une application commme mail drop ou mail trapp  (code tuto graphic art) !!!!
    }

}
