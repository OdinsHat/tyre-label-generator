<?php

namespace OdinsHat\EuTyreLabel;

use Tyre;

/**
 * Undocumented class
 */
class Label
{
    protected $tyre;
    protected $height;
    protected $images;

    /**
     * Undocumented function
     *
     * @param Tyre $tyre
     * @param integer $height
     * @param string $images
     */
    public function __construct(Tyre $tyre, int $height = 280, string $images = '/images')
    {
        $this->tyre = $tyre;
        $this->height = $height;
        $this->images = $images;
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
     * included CSS file must be linked in your page or the classes inside
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
     * Generates a PNG label from the component parts found in the images directory
     *
     * @return binary the PNG image
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

    /**
     * Method used for building the over layed image by taking arguments for which
     * variables and thereby which images to use
     */
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