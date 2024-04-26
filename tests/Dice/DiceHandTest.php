<?php

namespace App\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceHandTest extends TestCase
{
    /**
    * Stub the dices to assure the value can be asserted.
    */
    public function testAddStubbedDices()
    {
        // Create a stub for the Dice class.
        $stub = $this->createMock(Dice::class);

        // Configure the stub.
        $stub->method('roll')
            ->willReturn(6);
        $stub->method('getValue')
            ->willReturn(6);

        $dicehand = new DiceHand();
        $dicehand->add(clone $stub);
        $dicehand->add(clone $stub);
        $dicehand->roll();
        $res = $dicehand->sum();
        $this->assertEquals(12, $res);
    }

    public function testGetNumberDices()
    {
        $dicehand = new DiceHand();
        $stub = $this->createMock(Dice::class);
        $numberOfDices = 3;

        for ($i = 0; $i < $numberOfDices; $i++) {
            $dicehand->add(clone $stub);
        }

        $dicehand->roll();

        $res = $dicehand->getNumberDices();

        $this->assertEquals($numberOfDices, $res);
    }

    public function testGetValues()
    {
        $dicehand = new DiceHand();
        $stub = $this->createMock(Dice::class);
        $stub->method('getValue')
        ->willReturn(6);


        $numberOfDices = 3;

        for ($i = 1; $i <= $numberOfDices; $i++) {
            $dicehand->add(clone $stub);
        }

        $expectedValues = [6, 6, 6];
        $actualValues = $dicehand->getValues();

        $this->assertEquals($expectedValues, $actualValues);
    }

    public function testGetString()
    {
        $dicehand = new DiceHand();
        $stub = $this->createMock(Dice::class);
        $numberOfDices = 5;
        $expectedValues = [];

        for ($i = 1; $i <= $numberOfDices; $i++) {
            $stub->roll();
            $expectedValues[] = $stub->getAsString();
            $dicehand->add(clone $stub);
        }

        $actualValues = $dicehand->getString();

        $this->assertEquals($expectedValues, $actualValues);
    }

}
