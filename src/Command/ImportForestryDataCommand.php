<?php

namespace App\Command;

use App\Entity\Forestry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ImportForestryDataCommand extends Command
{
    protected static $defaultName = 'app:import-forestry-data';
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->setName('app:import-forestry-data')
            ->setDescription('Imports forestry data from a CSV file.')
            ->setHelp('This command allows you to import forestry data from a CSV file...');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $csvFile = __DIR__ . '/../../assets/example_data/test_data.csv'; // Update this path to your CSV file

        if (!file_exists($csvFile) || !is_readable($csvFile)) {
            $io->error('CSV file does not exist or is not readable.');
            return Command::FAILURE;
        }

        if (($handle = fopen($csvFile, 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ';')) !== false) {
                $forestryData = new Forestry();
                $forestryData->setYear((int)$data[0])
                            ->setHansynskravandeBiotoper((int)$data[1])
                            ->setSkyddszoner((int)$data[2])
                            ->setUpplevelsevarden((int)$data[3])
                            ->setTransportOverVattendrag((int)$data[4])
                            ->setKulturmiljoer(isset($data[5]) ? (int)$data[5] : null);

                $this->entityManager->persist($forestryData);
            }
            fclose($handle);

            $this->entityManager->flush();

            $io->success('Forestry data imported successfully.');
            return Command::SUCCESS;
        } else {
            $io->error('Unable to open CSV file.');
            return Command::FAILURE;
        }
    }
}
