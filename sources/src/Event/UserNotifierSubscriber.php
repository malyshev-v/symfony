<?php

namespace App\Event;

use App\Service\SmsSender;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Event Subscriber for notifications about creating, editing or deleting posts.
 *
 * @author Valeriy Malyshev <v.malyshev@piogroup.net>
 */
class UserNotifierSubscriber implements EventSubscriberInterface
{
    protected $mailer;
    protected $twig;
    protected $smsSender;

    public function __construct(MailerInterface $mailer, Environment $twig, SmsSender $smsSender)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->smsSender = $smsSender;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            PostDeletedEvent::NAME => [
                ['sendSms', 10],
                ['sendEmailOnDelete', 20],
            ],
            PostCreatedEvent::NAME => [
                ['sendEmailOnCreate', 10],
            ],
            PostEditedEvent::NAME => [
                ['sendSms', 10],
            ],
        ];
    }

    /**
     * Sending sms function
     */
    public function sendSms()
    {
        $this->smsSender->sendNotificationCreate('1234567890');
    }

    /**
     * Sending E-mail on post deleting function
     *
     * @param PostDeletedEvent $postDeletedEvent
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError|TransportExceptionInterface
     */
    public function sendEmailOnDelete(PostDeletedEvent $postDeletedEvent)
    {
        $content = $this->twig->render('email/delete.html.twig', [
            'post' => $postDeletedEvent->getPost(),
        ]);

        $postDeletedId = $postDeletedEvent->getPost()->getId();
        $content = 'Привет мой дорогой друг, тебе из проекта. Пост #'
            . $postDeletedId . ' был удален';

        $this->sendEmail($content);
    }

    /**
     * Sending E-mail on post creating function
     *
     * @param PostCreatedEvent $postCreatedEvent
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError|TransportExceptionInterface
     */
    public function sendEmailOnCreate(PostCreatedEvent $postCreatedEvent)
    {
        $content = $this->twig->render('email/create.html.twig', [
            'post' => $postCreatedEvent->getPost(),
        ]);

        $postCreatedId = $postCreatedEvent->getPost()->getId();
        $content = 'Привет мой дорогой друг, тебе из проекта. Пост #'
            . $postCreatedId . ' был создан';

        $this->sendEmail($content);
    }

    /**
     * Base sending E-mail function
     *
     * @param $content
     * @throws TransportExceptionInterface
     */
    public function sendEmail($content)
    {
        $mailer = $this->mailer;

        $message = new Email();
        $message->from('burm.courses@gmail.com');
        $message->to('v.malyshev@piogroup.net');
        $message->subject('Hello from Symfony!');
        $message->text($content);
        $message->html($content);

        $mailer->send($message);
    }
}
