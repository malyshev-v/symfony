<?php

namespace App\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\MailerInterface;

class PostCreatedSubscriber implements EventSubscriberInterface
{
    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            PostCreatedEvent::NAME => [
                'sendEmail' => 10,
            ],
        ];
    }

    public function sendEmail(MailerInterface $mailer)
    {
        // TODO: email sending
    }
}