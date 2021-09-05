<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class LuckyController
 *
 * @package App\Controller
 *
 * @Route ("/lucky")
 */
class LuckyController extends AbstractController
{
    /**
     * @Route ("/index", name="lucky_index")
     *
     * @return Response
     */
    public function indexAction() : Response
    {
        return $this->render('lucky/index.html.twig');
    }

    /**
     * @Route ("/test", name="lucky_test")
     *
     * @return Response
     */
    public function testAction() : Response
    {
        return $this->render('lucky/test.html.twig');
    }

    /**
     * @Route ("/number", name="lucky_number")
     *
     * @return Response
     */
    public function numberAction() : Response
    {
        return $this->render('lucky/number.html.twig');
    }
}
