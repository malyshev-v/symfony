<?php

namespace App\Tests\Controller\PostController;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ExportTest extends WebTestCase
{
    use PostTrait;

    /**
     * @return void
     */
    public function testSomething(): void
    {
        $client = static::createClient();
        $id = $this->getLastId();
        $uri = '/post/export/%d';
        $crawler = $client->request('GET', sprintf($uri, $id));

        $this->assertResponseIsSuccessful();
    }
}
