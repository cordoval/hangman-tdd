<?php

namespace Qandidate\AppBundle\Command;

use Qandidate\SqlStorage;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SqlCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('util:sql')
            ->setDescription('Creates SQLite database anew')
            ->setHelp(<<<EOF
The <info>%command.name%</info> command creates SQLite database anew:

  <info>php %command.full_name%</info>

EOF
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Resetting SQLite db');

        SqlStorage::wipeAndBoot(
            $this->getContainer()->getParameter('database_name'),
            $this->getContainer()->getParameter('database_user'),
            $this->getContainer()->getParameter('database_password')
        );

        $output->writeln('Done.');
    }
}