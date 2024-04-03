<?php

// src/Message/ContactNotification.php
namespace App\Message;

class ContactNotification
{
    public function __construct(
        private string $content,
    )
    {
    }

    public function getContent(): string
    {
        return $this->content;
    }

}