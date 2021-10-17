<?php

namespace App\Event;

use App\Service\SmsSender;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\MailerInterface;

class PostDeletedSubscriber implements EventSubscriberInterface
{
    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            PostDeletedEvent::NAME => [
                'sendSms'   => 10,
                'sendEmail' => 20,
            ],
        ];
    }

    public function sendSms(SmsSender $smsSender)
    {
        $smsSender->sendNotificationCreate('1234567890');
    }

    public function sendEmail(MailerInterface $mailer)
    {
        //TODO: sending Email
    }
}