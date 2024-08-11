<?php

namespace App\Command;

use App\Entity\Redlisted;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ImportRedlistedDataCommand extends Command
{
    protected static $defaultName = 'app:import-redlisted-data';
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Imports redlisted data from a CSV file.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $csvData = [
            [2000, 0.887, 0.875, 0.886, 0.779, 0.848, 0.912, 0.841, 0.846],
            [2005, 0.890, 0.875, 0.890, 0.832, 0.844, 0.914, 0.847, 0.849],
            [2010, 0.882, 0.874, 0.886, 0.832, 0.839, 0.912, 0.850, 0.866],
            [2015, 0.882, 0.874, 0.888, 0.853, 0.841, 0.913, 0.851, 0.875],
        ];

        foreach ($csvData as $row) {
            $redlisted = new Redlisted();
            $redlisted->setYear($row[0]);
            $redlisted->setFiskar($row[1]);
            $redlisted->setKarlvaxter($row[2]);
            $redlisted->setStorfjarilar($row[3]);
            $redlisted->setGrodOchKraldjur($row[4]);
            $redlisted->setBin($row[5]);
            $redlisted->setMossor($row[6]);
            $redlisted->setFaglar($row[7]);
            $redlisted->setDaggdjur($row[8]);

            $this->entityManager->persist($redlisted);
        }

        $this->entityManager->flush();

        $io->success('Data imported successfully.');

        return Command::SUCCESS;
    }
}
