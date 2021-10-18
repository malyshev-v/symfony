<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

/**
 * The post.edited event is dispatched each time a post is edited in the system.
 *
 * @author Valeriy Malyshev <v.malyshev@piogroup.net>
 */
class PostEditedEvent extends Event
{
    public const NAME = 'post.edited';
}
