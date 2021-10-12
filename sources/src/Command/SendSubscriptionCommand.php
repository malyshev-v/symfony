<?php

namespace App\Command;

use App\Entity\Subscription;
use App\Repository\PostRepository;
use App\Repository\SubscriptionRepository;
use Doctrine\DBAL\Driver\Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class SendSubscriptionCommand extends Command
{
    protected static $defaultName = 'send-subscription';
    protected static $defaultDescription = 'This is the command for sending new articles to subscribers';
    protected $postRepository;
    protected $emailsAddresses;
    protected $posts;
    protected $mailer;

    public function __construct(string $name = null, PostRepository $postRepository, SubscriptionRepository $subscriptionRepository, MailerInterface $mailer)
    {
        parent::__construct($name);

        $this->postRepository = $postRepository;
        $this->emailsAddresses = $this->getEmailAddresses($subscriptionRepository);
        $this->mailer = $mailer;
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this
            ->addArgument('daysCount', InputArgument::OPTIONAL, 'Count of days between mails')
            ->addOption('send-now', null, InputOption::VALUE_NONE, 'Option for sending right now');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws Exception
     * @throws TransportExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $daysCount = $input->getArgument('daysCount');
        $sendNow = $input->getOption('send-now');

        try {
            $posts = $this->getPosts($this->postRepository, $daysCount);
            $this->sendEmail($this->postRepository, $this->mailer, $daysCount, $this->emailsAddresses);
            $io->success('New parameters has been approved successfully!');
            return Command::SUCCESS;
        } catch (\Exception $ex) {
            $io->error('Something went wrong!' . $ex);
            return Command::FAILURE;
        }
    }

    /**
     * @throws TransportExceptionInterface
     */
    protected function sendEmail(PostRepository $postRepository, MailerInterface $mailer, int $daysCount, array $emailAddresses)
    {
        $emailsArr = [];
        $counter = 0;
        $postHtml = '';
        $posts = $this->getPosts($postRepository, $daysCount);

        foreach ($posts as $post) {
            $postHtml .= $post . '<br>';
        }

        foreach ($emailAddresses as $emailAddress) {
            $emailsArr[] = (new Email())
                ->from('burm.courses@gmail.com')
                ->to($emailAddress)
                ->subject('Feedback from Symfony blog')
                ->text(sprintf('Hi! You subscribed to the new posts, here they are: %s',
                    $postHtml))
                ->html(sprintf('Hi! You subscribed to the new posts, here they are: %s',
                    $postHtml));

            $mailer->send($emailsArr[0]);
            $counter++;
        }
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     * @throws Exception
     */
    protected function getPosts(PostRepository $postRepository, $daysCount)
    {
        return $postRepository->getForSubscription($daysCount);
    }

    /**
     * @param SubscriptionRepository $subscriptionRepository
     * @return Subscription[]
     */
    protected function getEmailAddresses(SubscriptionRepository $subscriptionRepository)
    {
        return $subscriptionRepository->findAll();
    }
}
