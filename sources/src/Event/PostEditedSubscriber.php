<?php

namespace App\Event;

use App\Service\SmsSender;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PostEditedSubscriber implements EventSubscriberInterface
{
    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            PostEditedEvent::NAME => [
                'sendSms' => 10,
            ],
        ];
    }

    public function sendSms(SmsSender $smsSender)
    {
        $smsSender->sendNotificationCreate('Post has been edited!');
    }
}