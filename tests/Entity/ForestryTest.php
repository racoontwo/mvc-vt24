<?php

use PHPUnit\Framework\TestCase;
use App\Entity\Forestry;

class ForestryTest extends TestCase
{
    public function testGetAndSetYear()
    {
        $forestry = new Forestry();
        $year = 2023;

        $forestry->setYear($year);
        $this->assertEquals($year, $forestry->getYear());
    }

    public function testGetAndSetHansynskravandeBiotoper()
    {
        $forestry = new Forestry();
        $hansynskravandeBiotoper = 10;

        $forestry->setHansynskravandeBiotoper($hansynskravandeBiotoper);
        $this->assertEquals($hansynskravandeBiotoper, $forestry->getHansynskravandeBiotoper());
    }

    public function testGetAndSetSkyddszoner()
    {
        $forestry = new Forestry();
        $skyddszoner = 5;

        $forestry->setSkyddszoner($skyddszoner);
        $this->assertEquals($skyddszoner, $forestry->getSkyddszoner());
    }

    public function testGetAndSetUpplevelsevarden()
    {
        $forestry = new Forestry();
        $upplevelsevarden = 15;

        $forestry->setUpplevelsevarden($upplevelsevarden);
        $this->assertEquals($upplevelsevarden, $forestry->getUpplevelsevarden());
    }

    public function testGetAndSetTransportOverVattendrag()
    {
        $forestry = new Forestry();
        $transportOverVattendrag = 20;

        $forestry->setTransportOverVattendrag($transportOverVattendrag);
        $this->assertEquals($transportOverVattendrag, $forestry->getTransportOverVattendrag());
    }

    public function testGetAndSetKulturmiljoer()
    {
        $forestry = new Forestry();
        $kulturmiljoer = 30;

        $forestry->setKulturmiljoer($kulturmiljoer);
        $this->assertEquals($kulturmiljoer, $forestry->getKulturmiljoer());

        $forestry->setKulturmiljoer(null);
        $this->assertNull($forestry->getKulturmiljoer());
    }
}
