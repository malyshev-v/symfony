<?php

namespace App\Event;

use App\Entity\Post;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * The post.deleted event is dispatched each time a post is deleted in the system.
 *
 * @author Valeriy Malyshev <v.malyshev@piogroup.net>
 */
class PostDeletedEvent extends Event
{
    public const NAME = 'post.deleted';

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
