<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class LuckyController
 * @package App\Controller
 *
 * @Route ("/lucky")
 */
class LuckyController extends AbstractController
{
    /**
     * @Route ("/test", name="lucky_test")
     */
    public function testAction() : Response
    {
        return $this->render('lucky/test.html.twig');
    }

    /**
     * @Route ("/number", name="lucky_number")
     */
    public function numberAction() : Response
    {
        return new Response('Number action!');
    }

    /**
     * @Route ("/index", name="lucky_index")
     */
    public function indexAction() : Response
    {
        return $this->render('lucky/index.html.twig');
    }
}
