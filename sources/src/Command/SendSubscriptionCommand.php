<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SendSubscriptionCommand extends Command
{
    protected static $defaultName = 'send-subscription';
    protected static $defaultDescription = 'Это команда для тестового курса Симфони';

    protected function configure(): void
    {
        $this
            ->addArgument('a', InputArgument::OPTIONAL, 'Argument description A')
            ->addArgument('b', InputArgument::OPTIONAL, 'Argument description B')
            ->addArgument('c', InputArgument::OPTIONAL, 'Argument description C')
            ->addOption('exclude-gmail', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $a = $input->getArgument('a');
        $b = $input->getArgument('b');
        $c = $input->getArgument('c');

//        $exclude = $input->getOption('exclude-gmail');

        $io->success('privet rebyata!');
        $io->error('privet rebyata error!');
        $output->writeln('<info>privet</info>');
//        var_dump($a, $b, $c);

//        if ($arg1) {
//            $io->note(sprintf('You passed an argument: %s', $arg1));
//        }
//
//        if ($input->getOption('option1')) {
//            // ...
//        }

//        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
