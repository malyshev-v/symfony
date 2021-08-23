<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;

/**
 * Class DefaultController
 * @package App\Controller
 *
 * @Route ("/")
 */
class DefaultController extends AbstractController
{
    /**
     * @Route ("/", name="default_index")
     *
     * @return Response
     */
    public function indexAction() : Response
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->findAll();
        dd($posts);

        return $this->render('default/index.html.twig', [
            'posts' => $posts,
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
