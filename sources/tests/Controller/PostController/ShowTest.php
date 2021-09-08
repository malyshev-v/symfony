<?php

namespace App\Tests\Controller\PostController;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ShowTest extends WebTestCase
{
    use PostTrait;

    /**
     * @return void
     */
    public function testSomething(): void
    {
        $client = static::createClient();
        $id = $this->getLastId();
        $uri = '/post/show/%d';
        $crawler = $client->request('GET', sprintf($uri, $id));

        $this->assertResponseIsSuccessful();
//        $this->assertSelectorTextContains('h1', 'Hello World');
    }
}
