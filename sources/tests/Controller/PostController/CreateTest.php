<?php

namespace App\Tests\Controller\PostController;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateTest extends WebTestCase
{
    use PostTrait;

    /**
     * @return void
     */
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/post/create');

        $this->assertResponseIsSuccessful();
    }

    /**
     * @return void
     */
    public function testRedirect(): void
    {
        $client = static::createClient();
        $previousLastId = $this->getLastId();

        $crawler = $client->request('GET', '/post/create');
        $this->assertResponseIsSuccessful();

        $form = $crawler->selectButton('Submit')->form();
        $form['post_form[name]'] = 'post name from phpUnit test';
        $form['post_form[description]'] = 'post description from phpUnit test';
        $client->submit($form);

        $currentLastId = $this->getLastId();

        $this->assertTrue($currentLastId > $previousLastId);
//        $this->assertResponseRedirects('/post/show/' . $currentLastId);
    }
}
