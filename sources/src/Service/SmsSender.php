<?php

namespace App\Service;

class SmsSender
{
    /**
     * @param string  $host
     * @param integer $port
     *
     * @return void
     */
    public function __construct($host, $port)
    {

    }

    /**
     * @return void
     */
    public function connect()
    {
        //...
    }

    /**
     * @param string $to
     * @param string $msg
     * @return void
     */
    public function send($to, $msg)
    {
        //...
    }

    /**
     * @param string $to
     * @return void
     */
    public function sendHello($to)
    {
        $this->send($to, 'Hello');
    }

    /**
     * @param string $to
     * @return void
     */
    public function sendNotificationEdit($to)
    {
        $this->send($to, 'Post edited');
    }

    /**
     * @param string $to
     * @return void
     */
    public function sendNotificationCreate($to)
    {
        $this->send($to, 'Post created');
    }
}
