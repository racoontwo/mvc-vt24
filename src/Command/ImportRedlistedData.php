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
            ->setName(self::$defaultName)
            ->setDescription('Imports redlisted species data from a CSV file.')
            ->setHelp('This command allows you to import redlisted species data from a CSV file...');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $csvFile = __DIR__ . '/../../assets/example_data/redlisted.csv'; // Update this path to your CSV file

        if (!file_exists($csvFile) || !is_readable($csvFile)) {
            $io->error('CSV file does not exist or is not readable.');
            return Command::FAILURE;
        }

        if (($handle = fopen($csvFile, 'r')) !== false) {
            // Skip the header row if present
            fgetcsv($handle, 1000, ',');

            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $redlisted = new Redlisted();
                $redlisted->setYear((int)$data[0])
                        ->setFiskar((int)$data[1])
                        ->setKarlvaxter((int)$data[2])
                        ->setStorfjarilar((int)$data[3])
                        ->setGrodOchKraldjur((int)$data[4])
                        ->setBin((int)$data[5])
                        ->setMossor((int)$data[6])
                        ->setFaglar((int)$data[7])
                        ->setDaggdjur((int)$data[8]);

                $this->entityManager->persist($redlisted);
            }
            fclose($handle);

            $this->entityManager->flush();

            $io->success('Redlisted data imported successfully.');
            return Command::SUCCESS;
        } else {
            $io->error('Unable to open CSV file.');
            return Command::FAILURE;
        }
    }
}
