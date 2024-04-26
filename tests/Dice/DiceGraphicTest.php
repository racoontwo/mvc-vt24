<?php

namespace App\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceGraphicTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateDiceGraphic()
    {
        $die = new DiceGraphic();
        $die->roll();
        $this->assertInstanceOf("\App\Dice\DiceGraphic", $die);
        // $this->assertInstanceOf(DiceGraphic::class, $die);

        $res = $die->getAsString();
        $this->assertNotEmpty($res);
    }

    public function testGetDiceGraphicAsString()
    {
        $representation = [
            '⚀',
            '⚁',
            '⚂',
            '⚃',
            '⚄',
            '⚅',
        ];
        
        $die = new DiceGraphic();
        $die->roll();
        $res = $die->getAsString();
        
        $this->assertNotEmpty($res);
        $this->assertContains($res, $representation);
    }
}