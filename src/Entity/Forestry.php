<?php

namespace App\Entity;

use App\Repository\ForestryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ForestryRepository::class)]
class Forestry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column]
    private ?int $hansynskravandeBiotoper = null;

    #[ORM\Column]
    private ?int $skyddszoner = null;

    #[ORM\Column]
    private ?int $upplevelsevarden = null;

    #[ORM\Column]
    private ?int $transportOverVattendrag = null;

    #[ORM\Column(nullable: true)]
    private ?int $kulturmiljoer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getHansynskravandeBiotoper(): ?int
    {
        return $this->hansynskravandeBiotoper;
    }

    public function setHansynskravandeBiotoper(int $hansynskravandeBiotoper): static
    {
        $this->hansynskravandeBiotoper = $hansynskravandeBiotoper;

        return $this;
    }

    public function getSkyddszoner(): ?int
    {
        return $this->skyddszoner;
    }

    public function setSkyddszoner(int $skyddszoner): static
    {
        $this->skyddszoner = $skyddszoner;

        return $this;
    }

    public function getUpplevelsevarden(): ?int
    {
        return $this->upplevelsevarden;
    }

    public function setUpplevelsevarden(int $upplevelsevarden): static
    {
        $this->upplevelsevarden = $upplevelsevarden;

        return $this;
    }

    public function getTransportOverVattendrag(): ?int
    {
        return $this->transportOverVattendrag;
    }

    public function setTransportOverVattendrag(int $transportOverVattendrag): static
    {
        $this->transportOverVattendrag = $transportOverVattendrag;

        return $this;
    }

    public function getKulturmiljoer(): ?int
    {
        return $this->kulturmiljoer;
    }

    public function setKulturmiljoer(?int $kulturmiljoer): static
    {
        $this->kulturmiljoer = $kulturmiljoer;

        return $this;
    }

     // Add the import method
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