<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

/**
 * The post.created event is dispatched each time a post is created in the system.
 */
class PostCreatedEvent extends Event
{
    public const NAME = 'post.created';
}