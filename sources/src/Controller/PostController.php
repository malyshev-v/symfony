<?php

namespace App\Controller;

use App\Event\PostCreatedEvent;
use App\Event\PostDeletedEvent;
use App\Event\PostEditedEvent;
use App\Form\PostForm;
use App\Repository\PostRepository;
use App\Service\PostExporter;
use App\Service\SmsSender;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;

/**
 * Class PostController
 *
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
     * @param LoggerInterface $logger
     * @param SmsSender $smsSender
     * @param EventDispatcherInterface $eventDispatcher
     * @return Response
     */
    public function createAction(
        Request $request,
        LoggerInterface $logger,
        SmsSender $smsSender,
        EventDispatcherInterface $eventDispatcher) : Response
    {
        $logger->info('Run create post method');
        $post = new Post();
        $post->setName('New post23');
        $post->setPublishedAt(new \DateTime());

        $postForm = $this->createForm(PostForm::class, $post);

        $postForm->handleRequest($request);
        if ($postForm->isSubmitted() && $postForm->isValid()) {
            $logger->info('Form is valid');
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            $logger->info('Post saved');

            $eventDispatcher->dispatch(new PostCreatedEvent($post), PostCreatedEvent::NAME);

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
     * @IsGranted("ROLE_ADMIN")
     *
     * @param Request $request
     * @param Post $post
     * @param EntityManagerInterface $em
     * @param SmsSender $smsSender
     * @param EventDispatcherInterface $eventDispatcher
     * @return Response
     */
    public function editAction(
        Request $request,
        Post $post,
        EntityManagerInterface $em,
        SmsSender $smsSender,
        EventDispatcherInterface $eventDispatcher) : Response
    {
        $postForm = $this->createForm(PostForm::class, $post);

        $postForm->handleRequest($request);
        if ($postForm->isSubmitted() && $postForm->isValid()) {
            $record = $postForm->getData();
            $em->persist($record);
            $em->flush();

            $eventDispatcher->dispatch(new PostEditedEvent(), PostEditedEvent::NAME);

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
     * @Route("/delete/{post}", name="post_delete")
     *
     * @param Post $post
     * @param EntityManagerInterface $em
     * @param MailerInterface $mailer
     * @param EventDispatcherInterface $eventDispatcher
     * @return Response
     */
    public function deleteAction(
        Post $post,
        EntityManagerInterface $em,
        MailerInterface $mailer,
        EventDispatcherInterface $eventDispatcher): Response
    {
        $eventDispatcher->dispatch(new PostDeletedEvent($post), PostDeletedEvent::NAME);

        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('default_index');
    }

    /**
     * @Route ("/show/{post}", name="post_show")
     *
     * @param Post $post
     *
     * @return Response
     */
    public function showAction(Post $post) : Response
    {
        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
    }

    /**
     * @Route ("/export/{post}", name="post_export")
     *
     * @param Post           $post
     * @param PostRepository $postRepository
     * @param Request        $request
     *
     * @return Response
     */
    public function exportAction(Post $post, PostRepository $postRepository, Request $request): Response
    {
        $postExporter = new PostExporter();
        $postExporter->writeInFile($post, $request->request->get('download_in_format'));

        return new Response('File saved');
    }
}
