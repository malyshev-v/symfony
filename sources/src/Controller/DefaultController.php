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
        ]);
    }
}
