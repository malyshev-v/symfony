<?php

namespace App\Tests\Controller\DefaultController;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FeedbackTest extends WebTestCase
{
    /**
     * @return void
     */
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/feedback');

        $this->assertResponseIsSuccessful();
//        $this->assertSelectorTextContains('h1', 'Hello World');
    }
}
