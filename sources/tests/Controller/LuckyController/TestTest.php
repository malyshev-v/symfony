<?php

namespace App\Tests\Controller\LuckyController;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestTest extends WebTestCase
{
    /**
     * @return void
     */
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/lucky/test');

        $this->assertResponseIsSuccessful();
//        $this->assertSelectorTextContains('h1', 'Hello World');
    }
}
