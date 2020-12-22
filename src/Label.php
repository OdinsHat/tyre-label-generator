<?php

namespace OdinsHat\EuTyreLabel;

class Label
{
    private $tyre;
    private $height;
    private $width;

    public function __construct(Tyre $tyre, int $width, int $height)
    {
        $this->tyre = $tyre;
        $this->width = $width;
        $this->height = $height;
    }

        /**
     * Generates a Tyre Label using inline CSS
     *
     * This isn't the recommended method but it is the easiest if you want to
     * get a quick & dirty tyre label up.
     *
     * @return string HTML of the tyre label images overlaid on each other
     */
    public function genHtmlLabel(): string
    {
        $label = '';

        $label .= '<div style="position:relative">';

        $label .= sprintf(
            '<img src="%s/bg.png" alt="EU tyre Label" style="position:relative; z-index:0;" />',
            $this->images_dir
        );
        $label .= self::overlayHtmlImage('fuel', $this->fuel);
        $label .= self::overlayHtmlImage('wet', $this->wet);
        $label .= self::overlayHtmlImage('db', $this->noise_db);
        $label .= self::overlayHtmlImage('sw', $this->sw);
        $label .= '</div>';

        return $label;
    }

    private function overlayHtmlImage($type, $val): string
    {
        return sprintf(
            '<img src="%s/%s_%s.png" style="position:absolute;top:0;left:0;z-index:1" />',
            $this->images_dir,
            $type,
            $val
        );
    }

    /**
     * Generates a tyre label using CSS classes - for this to work the
     * included CSS file must belinked in your page or the classes inside
     * it placed in your CSS.
     *
     * @return string HTML representation of an EU tyre label
     */
    public function genCssLabel(): string
    {
        $label = '';

        $label .= '<div class="tyre-label-container">';

        $label .= sprintf(
            '<img src="%s/bg.png" alt="EU Tyre Label" class="tyre-label-base" />',
            $this->images_dir
        );
        $label .= self::overlayCssImage('fuel', $this->fuel);
        $label .= self::overlayCssImage('wet', $this->wet);
        $label .= self::overlayCssImage('db', $this->noise_db);
        $label .= self::overlayCssImage('sw', $this->sw);
        $label .= '</div>';

        return $label;
    }

    private function overlayCssImage($type, $val): string
    {
        return sprintf(
            '<img src="%s/%s_%s.png" class="tyre-label-overlay" />',
            $this->images_dir,
            $type,
            $val
        );
    }

    /**
     * @todo complete this
     * @return [type] [description]
     */
    public function genPngLabel()
    {
        $image = imagecreatefrompng(
            sprintf(
                "%s/bg.png",
                $this->images_dir
            )
        );

        $image = self::overlayGdImage('fuel', $this->fuel, $image);
        $image = self::overlayGdImage('wet', $this->wet, $image);
        $image = self::overlayGdImage('db', $this->noise_db, $image);
        $image = self::overlayGdImage('sw', $this->sw, $image);

        return $image;
    }

    private function overlayGdImage($type, $val, $image)
    {

        $src = imagecreatefrompng(
            sprintf(
                "%s/%s_%s.png",
                $this->images_dir,
                $type,
                $val
            )
        );

        imagecopy($image, $src, 0, 0, 0, 0, imagesx($src), imagesy($src)); 

        return $image;
    }
}