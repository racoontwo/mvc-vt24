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

    public function setHanosynskravandeBiotoper(int $hansynskravandeBiotoper): static
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
}
