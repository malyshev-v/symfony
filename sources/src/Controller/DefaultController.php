<?php

namespace App\Controller;

use App\Form\FeedbackForm;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Email;

/**
 * Class DefaultController
 *
 * @package App\Controller
 *
 * @Route ("/")
 */
class DefaultController extends AbstractController
{
    public function defaultLocaleAction(Request $request): RedirectResponse
    {
        $referer = $request->headers->get('referer');
        return ($referer ? $this->redirect($referer) : $this->redirectToRoute('default_index'));
//        return new RedirectResponse($referer);
//        return (gettype($referer) == RedirectResponse::class ? $this->redirect($referer) : $this->redirectToRoute('default_index'));
    }

    /**
     * @Route ("/", name="default_index")
     *
     * @param PostRepository $postRepository
     *
     * @return Response
     */
    public function indexAction(PostRepository $postRepository) : Response
    {
        $posts = $postRepository->findAll(['published_at' => 'desc']);

        return $this->render('default/index.html.twig', [
            'posts' => $posts,
            'title' => 'Symfony Blog',
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
     * @param Request $request
     * @param MailerInterface $mailer
     *
     * @return Response
     *
     * @throws TransportExceptionInterface
     */
    public function feedbackAction(Request $request, MailerInterface $mailer) : Response
    {
        $feedbackForm = $this->createForm(FeedbackForm::class);
        $feedbackForm->handleRequest($request);

        if ($feedbackForm->isSubmitted() && $feedbackForm->isValid()) {
            $data = $feedbackForm->getData();
            $email = (new Email())
                ->from('burm.courses@gmail.com')
                ->to('v.malyshev@piogroup.net')
                ->subject('Feedback from Symfony blog')
                ->text(sprintf('Hi! My name is %s and it is my feedback about your blog! \n
                    I think the next: %s. If u want to give a question, u can find me by my contacts: %s. Best regards!',
                    $data['name'], $data['contacts'], $data['description']))
                ->html(str_replace(
                    array('SenderName', 'SenderContacts', 'SenderMessage'),
                    array($data['name'], $data['contacts'], $data['description']),
                    file_get_contents(__DIR__ . '/../../templates/default/email/feedback.html')));

            $mailer->send($email);

            $this->addFlash(
                'notice',
                'Your feedback has been successfully sent!'
            );
        }

        return $this->render('default/feedback.html.twig', [
            'form' => $feedbackForm->createView(),
        ]);
    }
}
