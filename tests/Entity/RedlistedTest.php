<?php

use PHPUnit\Framework\TestCase;
use App\Entity\Redlisted;

class RedlistedTest extends TestCase
{
    public function testGetAndSetYear()
    {
        $redlisted = new Redlisted();
        $year = 2024;

        $redlisted->setYear($year);
        $this->assertEquals($year, $redlisted->getYear());
    }

    public function testGetAndSetFiskar()
    {
        $redlisted = new Redlisted();
        $fiskar = 12.5;

        $redlisted->setFiskar($fiskar);
        $this->assertEquals($fiskar, $redlisted->getFiskar());
    }

    public function testGetAndSetKarlvaxter()
    {
        $redlisted = new Redlisted();
        $karlvaxter = 3.4;

        $redlisted->setKarlvaxter($karlvaxter);
        $this->assertEquals($karlvaxter, $redlisted->getKarlvaxter());
    }

    public function testGetAndSetStorfjarilar()
    {
        $redlisted = new Redlisted();
        $storfjarilar = 7.8;

        $redlisted->setStorfjarilar($storfjarilar);
        $this->assertEquals($storfjarilar, $redlisted->getStorfjarilar());
    }

    public function testGetAndSetGrodOchKraldjur()
    {
        $redlisted = new Redlisted();
        $grodOchKraldjur = 5.1;

        $redlisted->setGrodOchKraldjur($grodOchKraldjur);
        $this->assertEquals($grodOchKraldjur, $redlisted->getGrodOchKraldjur());
    }

    public function testGetAndSetBin()
    {
        $redlisted = new Redlisted();
        $bin = 4.6;

        $redlisted->setBin($bin);
        $this->assertEquals($bin, $redlisted->getBin());
    }

    public function testGetAndSetMossor()
    {
        $redlisted = new Redlisted();
        $mossor = 2.9;

        $redlisted->setMossor($mossor);
        $this->assertEquals($mossor, $redlisted->getMossor());
    }

    public function testGetAndSetFaglar()
    {
        $redlisted = new Redlisted();
        $faglar = 6.3;

        $redlisted->setFaglar($faglar);
        $this->assertEquals($faglar, $redlisted->getFaglar());
    }

    public function testGetAndSetDaggdjur()
    {
        $redlisted = new Redlisted();
        $daggdjur = 8.7;

        $redlisted->setDaggdjur($daggdjur);
        $this->assertEquals($daggdjur, $redlisted->getDaggdjur());
    }
}
