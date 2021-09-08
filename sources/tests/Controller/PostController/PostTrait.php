<?php

namespace App\Tests\Controller\PostController;

use App\Repository\PostRepository;

trait PostTrait
{
    /**
     * @return mixed
     */
    public function getLastId()
    {
        $postRepository = static::getContainer()->get(PostRepository::class);
        $postId = $postRepository->findOneBy([], ['id' => 'desc']);

        return $postId->getId();
    }
}