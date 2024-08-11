<?php

namespace App\Entity;

use App\Repository\RedlistedRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RedlistedRepository::class)]
class Redlisted
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column]
    private ?float $fiskar = null;

    #[ORM\Column]
    private ?float $karlvaxter = null;

    #[ORM\Column]
    private ?float $storfjarilar = null;

    #[ORM\Column]
    private ?float $grodOchKraldjur = null;

    #[ORM\Column]
    private ?float $bin = null;

    #[ORM\Column]
    private ?float $mossor = null;

    #[ORM\Column]
    private ?float $faglar = null;

    #[ORM\Column]
    private ?float $daggdjur = null;

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

    public function getFiskar(): ?float
    {
        return $this->fiskar;
    }

    public function setFiskar(float $fiskar): static
    {
        $this->fiskar = $fiskar;

        return $this;
    }

    public function getKarlvaxter(): ?float
    {
        return $this->karlvaxter;
    }

    public function setKarlvaxter(float $karlvaxter): static
    {
        $this->karlvaxter = $karlvaxter;

        return $this;
    }

    public function getStorfjarilar(): ?float
    {
        return $this->storfjarilar;
    }

    public function setStorfjarilar(float $storfjarilar): static
    {
        $this->storfjarilar = $storfjarilar;

        return $this;
    }

    public function getGrodOchKraldjur(): ?float
    {
        return $this->grodOchKraldjur;
    }

    public function setGrodOchKraldjur(float $grodOchKraldjur): static
    {
        $this->grodOchKraldjur = $grodOchKraldjur;

        return $this;
    }

    public function getBin(): ?float
    {
        return $this->bin;
    }

    public function setBin(float $bin): static
    {
        $this->bin = $bin;

        return $this;
    }

    public function getMossor(): ?float
    {
        return $this->mossor;
    }

    public function setMossor(float $mossor): static
    {
        $this->mossor = $mossor;

        return $this;
    }

    public function getFaglar(): ?float
    {
        return $this->faglar;
    }

    public function setFaglar(float $faglar): static
    {
        $this->faglar = $faglar;

        return $this;
    }

    public function getDaggdjur(): ?float
    {
        return $this->daggdjur;
    }

    public function setDaggdjur(float $daggdjur): static
    {
        $this->daggdjur = $daggdjur;

        return $this;
    }
}
