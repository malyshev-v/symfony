<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CreateUserType;
use App\Form\ForgotPasswordType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

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
     * @Route ("/signup", name="register")
     *
     * @param Request $request
     * @param UserPasswordHasherInterface $passwordHasher
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function signUpAction(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $em) : Response
    {
        $createUserForm = $this->createForm(CreateUserType::class);
        $createUserForm->handleRequest($request);

        if ($createUserForm->isSubmitted() && $createUserForm->isValid()) {
            try {
                $user = new User();

                $password = $createUserForm->getData()->getPassword();
                $hashedPassword = $passwordHasher->hashPassword($user, $password);

                $user->setLogin($createUserForm->getData()->getLogin());
                $user->setPassword($hashedPassword);
                $user->setRoles(["ROLE_USER"]);

                $em->persist($user);
                $em->flush();
                $this->addFlash('success', 'New user has been successfully created!');

                return $this->render('user/sign_up.html.twig', [
                    'form' => $createUserForm->createView(),
                ]);
            } catch (\Exception $ex) {
                $this->addFlash('error', 'Something went wrong! Error: ' . $ex);

                return $this->render('user/sign_up.html.twig', [
                    'form' => $createUserForm->createView(),
                ]);
            }
        }

        return $this->render('user/sign_up.html.twig', [
            'form' => $createUserForm->createView(),
        ]);
    }

    /**
     * @Route ("/signin", name="login")
     *
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function signInAction(AuthenticationUtils $authenticationUtils) : Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('user/sign_in.html.twig', [
            'error'        => $error,
            'lastUsername' => $lastUsername,
        ]);
    }

    /**
     * @Route ("/forgot", name="user_forgot")
     *
     * @param Request $request
     * @param MailerInterface $mailer
     * @param UserRepository $userRepository
     * @param UserPasswordHasherInterface $passwordHasher
     * @return Response
     * @throws TransportExceptionInterface
     */
    public function forgotPasswordAction(Request $request, MailerInterface $mailer, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher) : Response
    {
        $form = $this->createForm(ForgotPasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $emailAddress = $form->getData()['Email'];
                $user = $userRepository->findOneBy(['email' => $emailAddress]);
                $newPassword = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'),0,10);
                $newHashedPassword = $passwordHasher->hashPassword($user, $newPassword);

                $user->setPassword($user, $newHashedPassword);

                $email = (new Email())
                    ->from('burm.courses@gmail.com')
                    ->to($emailAddress)
                    ->subject('Your new password')
                    ->text(sprintf('Hi! This is your new password: %s. Best regards!', $newPassword))
                    ->html(sprintf('Hi! This is your new password: %s. Best regards!', $newPassword));

                $mailer->send($email);

                $this->addFlash('notice','Your feedback has been successfully sent!');
            } catch (\Exception $ex) {
                $this->addFlash('error', 'Something went wrong!');
            }
        }

        return $this->render('user/forgot.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
