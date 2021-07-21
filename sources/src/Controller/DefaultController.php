<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App\Controller
 *
 * @Route ("/")
 */
class DefaultController extends  AbstractController
{
    /**
     * @Route ("/", name="default_index")
     *
     * @return Response
     */
    public function indexAction() : Response
    {
        $a = 10;
        $b = 20;

        $c = $a + $b;
        $userName = 'Alex';

        $users = [
            ['id' => 1, 'name' => 'Alex',],
            ['id' => 2, 'name' => 'Mike',],
            ['id' => 3, 'name' => 'John',],
        ];

        return $this->render('default/index.html.twig', [
            'c' => $c,
            'userName' => $userName,
            'users' => $users
        ]);
    }

    /**
     * @Route ("/about", name="default_about")
     *
     * @return Response
     */
    public function aboutAction() : Response
    {
        return $this->render('default/about.html.twig');
    }

    /**
     * @Route ("/feedback", name="default_feedback")
     *
     * @return Response
     */
    public function feedbackAction() : Response
    {
        return $this->render('default/feedback.html.twig');
    }
}
