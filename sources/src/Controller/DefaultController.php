<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
     * @param PostRepository $postRepository
     * @return Response
     */
    public function indexAction(PostRepository $postRepository) : Response
    {
        $posts = $postRepository->findAll(['published_at' => 'desc']);

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
