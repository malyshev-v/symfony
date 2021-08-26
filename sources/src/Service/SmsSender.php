<?php

namespace App\Service;

class SmsSender
{
    public function __construct($host, $port)
    {

    }

    public function connect()
    {
        //...
    }

    public function send($to, $msg)
    {
        //...
    }

    public function sendHello($to)
    {
        $this->send($to, 'Hello');
    }

    public function sendNotificationEdit($to)
    {
        $this->send($to, 'Post edited');
    }

    public function sendNotificationCreate($to)
    {
        $this->send($to, 'Post created');
    }
}