<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @IsGranted("ROLE_ADMIN")
 *
 * @package App\Controller
 *
 * @Route ("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route ("/", name="default_index_adm")
     *
     * @param PostRepository $postRepository
     *
     * @return Response
     */
    public function indexAction(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findAll(['published_at' => 'desc']);

        return $this->render('default/index.html.twig', [
            'posts' => $posts,
            'title' => 'Admin Controller'
        ]);
    }

}
