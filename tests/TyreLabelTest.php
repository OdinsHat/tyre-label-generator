<?php
require('TyreLabel.php');

class TyreLabelTest extends PHPUnit_Framework_TestCase
{
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