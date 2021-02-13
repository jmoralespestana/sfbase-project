<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class TestMailCommand extends Command
{
    protected static $defaultName = 'test:mail';
    protected static $defaultDescription = 'Add a short description for your command';
    private $mailer;

    public function __construct(?string $name = null, MailerInterface $mailer)
    {
        parent::__construct($name);
        $this->mailer = $mailer;
    }

    protected function configure()
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $email = (new Email())
            ->from('administrator@localhost.com')
            ->to('jmoralespestana@localhost.com')
            ->subject('TESTING EMAIL')
            ->text('THIS IS EASY AS CAKE');

        $this->mailer->send($email);

        return Command::SUCCESS;
    }
}
