<?php

namespace App\Tests\Controller\PostController;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ShowTest extends WebTestCase
{
    /**
     * @return mixed
     */
    public function getPostId()
    {
        $postRepository = static::getContainer()->get(PostRepository::class);
        $postId = $postRepository->findOneBy([], ['id' => 'desc']);

        return $postId->getId();
    }

    /**
     * @return void
     */
    public function testSomething(): void
    {
        $client = static::createClient();
        $id = $this->getPostId();
        $uri = '/post/show/%d';
        $crawler = $client->request('GET', sprintf($uri, $id));

        $this->assertResponseIsSuccessful();
//        $this->assertSelectorTextContains('h1', 'Hello World');
    }
}
