<?php

namespace App\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateDice(): void
    {
        $die = new Dice();
        $this->assertInstanceOf("\App\Dice\Dice", $die);

        $res = $die->getAsString();
        $this->assertNotEmpty($res);
    }

    /**
     * Create a mocked object that always returns 6.
     */
    public function testStubRollDiceLastRoll(): void
    {
        // Create a stub for the Dice class.
        $stub = $this->createMock(Dice::class);

        // Configure the stub.
        $stub->method('roll')
            ->willReturn(6);

        $res = $stub->roll();
        $exp = 6;
        $this->assertEquals($exp, $res);
    }

    /**
     * Roll object and verify that the object has changed value
     * in most cases, use no arguments.
     */
    public function testRoll(): void
    {
        $die = new Dice();

        $initialResult = $die->roll();
        $changed = false;

        for ($i = 0; $i < 10; $i++) {
            $newResult = $die->roll();

            $this->assertGreaterThanOrEqual(1, $newResult);
            $this->assertLessThanOrEqual(6, $newResult);

            if ($newResult !== $initialResult) {
                $changed = true;
                break;
            }
        }

        $this->assertTrue($changed, "The result should change in most cases.");
    }

    /**
     * Test a value between 1-6 is returned from getValue.
     */
    public function testGetValue(): void
    {
        $die = new Dice();
        $die->roll();

        $result = $die->getValue();

        $this->assertGreaterThanOrEqual(1, $result);
        $this->assertLessThanOrEqual(6, $result);
    }

}
