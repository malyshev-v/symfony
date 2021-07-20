<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package App\Controller
 *
 * @Route ("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route ("/test", name="user_test")
     */
    public function testAction() : Response
    {
        return $this->render('user/test.html.twig');
    }
}
