<?php

namespace App\Tests\Controller\PostController;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AddTest extends WebTestCase
{
    /**
     * @return void
     */
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/post/add');

        $this->assertResponseIsSuccessful();
//        $this->assertSelectorTextContains('h1', 'Hello World');
    }
}
