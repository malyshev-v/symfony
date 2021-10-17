<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

/**
 * The post.edited event is dispatched each time a post is edited in the system.
 */
class PostEditedEvent extends Event
{
    public const NAME = 'post.edited';
}