<?php

namespace Qandidate\AppBundle\Command;

use Qandidate\SqliteStorage;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SqliteCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Resetting SQLite db');

        SqliteStorage::wipeAndBoot();

        $output->writeln('Done.');
    }
}