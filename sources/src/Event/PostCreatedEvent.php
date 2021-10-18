<?php

namespace App\Event;

use App\Entity\Post;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * The post.created event is dispatched each time a post is created in the system.
 *
 * @author Valeriy Malyshev <v.malyshev@piogroup.net>
 */
class PostCreatedEvent extends Event
{
    public const NAME = 'post.created';

    protected $post;

    public function __construct(Post $post = null)
    {
        $this->post = $post;
    }

    /**
     * Getter for the post object
     *
     * @return Post|null
     */
    public function getPost(): ?Post
    {
        return $this->post;
    }
}
