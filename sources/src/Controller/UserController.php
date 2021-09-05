<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 *
 * @package App\Controller
 *
 * @Route ("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route ("/test", name="user_test")
     *
     * @return Response
     */
    public function testAction() : Response
    {
        return $this->render('user/test.html.twig');
    }

    /**
     * @Route ("/signup", name="user_signup")
     *
     * @return Response
     */
    public function signUpAction() : Response
    {
        return $this->render('user/sign_up.html.twig');
    }

    /**
     * @Route ("/signin", name="user_signin")
     *
     * @return Response
     */
    public function signInAction() : Response
    {
        return $this->render('user/sign_in.html.twig');
    }
}
