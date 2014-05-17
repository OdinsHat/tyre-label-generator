<?php
require('TyreLabel.php');

class TyreLabelTest extends PHPUnit_Framework_TestCase
{
    public function testFilesExist()
    {
        $dir = 'images';
        $this->assertFileExists("$dir/fuel_a.png");
        $this->assertFileExists("$dir/fuel_b.png");
        $this->assertFileExists("$dir/fuel_c.png");
        $this->assertFileExists("$dir/fuel_d.png");
        $this->assertFileExists("$dir/fuel_e.png");
        $this->assertFileExists("$dir/fuel_f.png");
        $this->assertFileExists("$dir/fuel_g.png");
        $this->assertFileExists("$dir/wet_a.png");
        $this->assertFileExists("$dir/wet_b.png");
        $this->assertFileExists("$dir/wet_c.png");
        $this->assertFileExists("$dir/wet_d.png");
        $this->assertFileExists("$dir/wet_e.png");
        $this->assertFileExists("$dir/wet_f.png");
        $this->assertFileExists("$dir/wet_g.png");
        $this->assertFileExists("$dir/wet_a.png");
        $this->assertFileExists("$dir/sw_0.png");
        $this->assertFileExists("$dir/sw_1.png");
        $this->assertFileExists("$dir/sw_2.png");
    }

    public function testNoInlineStyleInCssGen()
    {
        $label = new TyreLabel('F', 'E', 71, 2, '280', '/label');
        $this->assertNotContains('style=', $label->genCssLabel());
    }

    public function testCorrectPathInserted()
    {
        $label = new TyreLabel('F', 'E', 71, 2, '280', '/blahlabelimages');
        $this->assertContains('/blahlabelimages', $label->genCssLabel());
        $this->assertContains('/blahlabelimages', $label->genHtmlLabel());
    }

    public function testFuelClassImageCorrect()
    {
        $label = new TyreLabel('F', 'E', 71, 2, '280', '/blahlabelimages');
        $this->assertContains('fuel_f.png', $label->genCssLabel());
        $this->assertContains('fuel_f.png', $label->genHtmlLabel());
    }

    public function testWetGripClassimageCorrect()
    {
        $label = new TyreLabel('F', 'E', 71, 2, '280', '/blahlabelimages');
        $this->assertContains('wet_e.png', $label->genCssLabel());
        $this->assertContains('wet_e.png', $label->genHtmlLabel());
    }

    public function testHtmlTyreLabel()
    {
        $this->expectOutputString('<div style="position:relative"><img src="/label/bg.png" alt="EU tyre Label" style="position:relative; z-index:0;" /><img src="/label/fuel_f.png" style="position:absolute;top:0;left:0;z-index:1" /><img src="/label/wet_e.png" style="position:absolute;top:0;left:0;z-index:1" /><img src="/label/db_71.png" style="position:absolute;top:0;left:0;z-index:1" /><img src="/label/sw_2.png" style="position:absolute;top:0;left:0;z-index:1" /></div>');
        $label = new TyreLabel('F', 'E', 71, 2, '280', '/label');
        print $label->genHtmlLabel();
    }

    public function testCssTyreLabel()
    {
        $this->expectOutputString('<div class="tyre-label-container"><img src="/label/bg.png" alt="EU Tyre Label" class="tyre-label-base" /><img src="/label/fuel_f.png" class="tyre-label-overlay" /><img src="/label/wet_e.png" class="tyre-label-overlay" /><img src="/label/db_71.png" class="tyre-label-overlay" /><img src="/label/sw_2.png" class="tyre-label-overlay" /></div>');
        $label = new TyreLabel('F', 'E', 71, 2, '280', '/label');
        print $label->genCssLabel();
    }
}

?>