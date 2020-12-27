<?php

namespace OdinsHat\TyreLabelGenerator;

use PHPUnit\Framework\TestCase;

class TyreTest extends TestCase
{
    public function testNoiseDb()
    {
        $tyre = new Tyre('F', 'E', 71, 2);
        $this->assertEquals(71, $tyre->getNoiseDb(), 'Noise DB is reporting an incorrect value');
    }

    /**
     * @dataProvider validNoiseClassses
     */
    public function testValidNoiseClasses($expectedInt, $noise)
    {
        $this->assertEquals($expectedInt, $noise->getNoiseClass(), 'Noise Class is reporting an incorrect value');
    }

    /**
     * @dataProvider validWetClasses
     */
    public function testvalidWetClasses($expectedString, $rating)
    {
        $this->assertEquals($expectedString, $rating->getWet());
    }

    /**
     * @dataProvider inValidNoiseClasses
     * @throws \Exception
     */
    public function testInValidNoiseClasses($noiseClass)
    {
        $this->expectException(\Exception::class);
        $tyre = new Tyre('A', 'E', 71, $noiseClass);
    }

    /**
     * @dataProvider invalidFuelRatings
     * @throws \Exception
     */
    public function testInvalidFuelRating($invalidFuelRating)
    {
        $this->expectException(\Exception::class);
        $tyre = new Tyre($invalidFuelRating, 'E', 71, 2);
    }

    public function validWetClasses()
    {
        return [
            ['E', new Tyre('F', 'E', 71, 2)],
            ['E', new Tyre('F', 'e', 71, 2)],
            ['A', new Tyre('F', 'A', 71, 2)],
            ['G', new Tyre('F', 'g', 71, 2)],
        ];
    }

    public function validNoiseClassses()
    {
        return [
            [1, new Tyre('F', 'E', 71, 1)],
            [2, new Tyre('F', 'e', 71, 2)],
            [3, new Tyre('F', 'A', 71, 3)]
        ];
    }

    public function inValidNoiseClasses()
    {
        return [
            [5],
            ['22'],
            ['56'],
            [23]
        ];
    }

    public function invalidFuelRatings()
    {
        return [
            ['DF'],
            [1],
            [4],
            ['1'],
            ['ab']
        ];
    }
}
