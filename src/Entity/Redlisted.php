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
    private ?int $fiskar = null;

    #[ORM\Column]
    private ?int $karlvaxter = null;

    #[ORM\Column]
    private ?int $storfjarilar = null;

    #[ORM\Column]
    private ?int $grodOchKraldjur = null;

    #[ORM\Column]
    private ?int $bin = null;

    #[ORM\Column]
    private ?int $mossor = null;

    #[ORM\Column]
    private ?int $faglar = null;

    #[ORM\Column]
    private ?int $daggdjur = null;

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

    public function getFiskar(): ?int
    {
        return $this->fiskar;
    }

    public function setFiskar(int $fiskar): static
    {
        $this->fiskar = $fiskar;

        return $this;
    }

    public function getKarlvaxter(): ?int
    {
        return $this->karlvaxter;
    }

    public function setKarlvaxter(int $karlvaxter): static
    {
        $this->karlvaxter = $karlvaxter;

        return $this;
    }

    public function getStorfjarilar(): ?int
    {
        return $this->storfjarilar;
    }

    public function setStorfjarilar(int $storfjarilar): static
    {
        $this->storfjarilar = $storfjarilar;

        return $this;
    }

    public function getGrodOchKraldjur(): ?int
    {
        return $this->grodOchKraldjur;
    }

    public function setGrodOchKraldjur(int $grodOchKraldjur): static
    {
        $this->grodOchKraldjur = $grodOchKraldjur;

        return $this;
    }

    public function getBin(): ?int
    {
        return $this->bin;
    }

    public function setBin(int $bin): static
    {
        $this->bin = $bin;

        return $this;
    }

    public function getMossor(): ?int
    {
        return $this->mossor;
    }

    public function setMossor(int $mossor): static
    {
        $this->mossor = $mossor;

        return $this;
    }

    public function getFaglar(): ?int
    {
        return $this->faglar;
    }

    public function setFaglar(int $faglar): static
    {
        $this->faglar = $faglar;

        return $this;
    }

    public function getDaggdjur(): ?int
    {
        return $this->daggdjur;
    }

    public function setDaggdjur(int $daggdjur): static
    {
        $this->daggdjur = $daggdjur;

        return $this;
    }
}
