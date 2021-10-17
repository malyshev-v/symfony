<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

/**
 * The post.deleted event is dispatched each time a post is deleted in the system.
 */
class PostDeletedEvent extends Event
{
    public const NAME = 'post.deleted';
}