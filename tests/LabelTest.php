<?php

namespace OdinsHat\TyreLabelGenerator;

use PHPUnit\Framework\TestCase;

/**
 * @var Label
 */

class LabelTest extends TestCase
{

    public function testTyre()
    {

    }

    public function testHtmlImage()
    {

    }

    public function testCssImage()
    {

    }

    public function testHeightProvided()
    {
        $tyre = new Tyre('F', 'E', 71, 2);
        $label = new Label($tyre, 300, 'imgs/');
        $this->assertEquals(300, $label->getHeight());
    }

    public function testDefaultHeight()
    {
        $tyre = new Tyre('F', 'E', 71, 2);
        $label = new Label($tyre);
        $this->assertEquals(280, $label->getHeight(), 'Default height not being set to 280 as expected');
    }

    public function testImagesDir()
    {
        $tyre = new Tyre('F', 'E', 71, 2);
        $label = new Label($tyre);
        $this->assertEquals('/images', $label->getImagesDir());
    }

    public function testImagesDirProvided()
    {
        $tyre = new Tyre('F', 'E', 71, 2);
        $label = new Label($tyre, 300, '/imgs');
        $this->assertEquals('/imgs', $label->getImagesDir());
    }
}
