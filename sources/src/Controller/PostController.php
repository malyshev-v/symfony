<?php

namespace App\Controller;

use App\Form\PostForm;
use Symfony\Component\HttpFoundation\Request;
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
    public function addAction(): Response
    {
        $post = new Post();
        $postNumber = rand(0, 1000);
        $post->setName('Новость № ' . $postNumber);
        $post->setDescription('Содержание новости № ' . $postNumber);
        $post->setPublishedAt(new \DateTime());
        $post->setPublishedBy('admin');

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return new Response('Post #' . $postNumber . ' added');
    }

    /**
     * @Route ("/create", name="post_create")
     *
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request) : Response
    {
        $post = new Post();
        $post->setName('New post23');
        $post->setPublishedAt(new \DateTime());

        $postForm = $this->createForm(PostForm::class, $post);

        $postForm->handleRequest($request);
        if ($postForm->isSubmitted() && $postForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('post_show', [
                'post' => $post->getId(),
            ]);
        }

        return $this->render('post/create.html.twig', [
            'post' => $post->getId(),
            'postForm' => $postForm->createView(),
        ]);
    }

    /**
     * @Route ("/edit/{post}", name="post_edit")
     *
     * @param Request $request
     * @param Post    $post
     * @return Response
     */
    public function editAction(Request $request, Post $post) : Response
    {
        $em = $this->getDoctrine()->getManager();
        $postForm = $this->createForm(PostForm::class, $post);

        $postForm->handleRequest($request);
        if ($postForm->isSubmitted() && $postForm->isValid()) {
            $record = $postForm->getData();
            $em->persist($record);
            $em->flush();

            return $this->redirectToRoute('post_show', [
                'post' => $post->getId(),
            ]);
        }

        return $this->render('post/edit.html.twig', [
            'post' => $post,
            'postForm' => $postForm->createView(),
        ]);
    }

    /**
     * @Route ("/show/{post}", name="post_show")
     *
     * @param Post $post
     * @return Response
     */
    public function showAction(Post $post) : Response
    {
        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
    }
}
