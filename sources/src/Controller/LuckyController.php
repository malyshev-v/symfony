<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LuckyController extends AbstractController
{
    /**
     * @Route ("/lucky/test", name="lucky_test")
     */
    public function testAction() : Response
    {
        return $this->render('test.html.twig');
    }

    /**
     * @Route ("/lucky/number", name="lucky_number")
     */
    public function numberAction()
    {
        echo 'Number action';
        die;
    }

    /**
     * @Route ("/lucky/index", name="lucky_index")
     */
    public function indexAction() : Response
    {
        return $this->render('lucky/index.html.twig');
    }
}
