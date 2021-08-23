<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;

/**
 * Class PostController
 * @package App\Controller
 *
 * @Route ("/post")
 */
class PostController extends AbstractController
{
    /**
     * @Route ("/add", name="post_add")
     *
     * @return Response
     */
    public function addPost(): Response
    {
        $post = new Post();
        $postNumber = rand(0, 1000);
        $post->setName('Новость № ' . $postNumber);
        $post->setDescription('Содержание новости № ' . $postNumber);
        $post->setPublishedAt(new \DateTime());

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return new Response('Post #' . $postNumber . ' added');
    }
}
