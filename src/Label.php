<?php

declare(strict_types=1);

/*
 * This file is subject to the
 * BSD 3 clause open source license.
 * (c) Copyright Doug Bromley
 */

namespace OdinsHat\TyreLabelGenerator;

/**
 * Label class will build an EU standard tyre label using a Tyre object
 * provided during its initialisation.
 */
class Label
{
    protected $tyre;
    protected $height;
    protected $images;

    /**
     * Constructor function for accepting a tyre object as well as 2 optional arguments for
     * customising the label as the user sees fit.
     */
    public function __construct(Tyre $tyre, int $height = 280, string $images = '/images')
    {
        $this->tyre = $tyre;
        $this->height = $height;
        $this->images = $images;
    }

    public function getImagesDir(): string
    {
        return $this->images;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    public function setImagesDir(string $images): void
    {
        $this->images = $images;
    }

    /**
     * Generates a Tyre Label using inline CSS.
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
            $this->images
        );
        $label .= $this->overlayHtmlImage('fuel', $this->tyre->getFuel());
        $label .= $this->overlayHtmlImage('wet', $this->tyre->getWet());
        $label .= $this->overlayHtmlImage('db', $this->tyre->getNoiseDb());
        $label .= $this->overlayHtmlImage('sw', $this->tyre->getNoiseClass());
        $label .= '</div>';

        return $label;
    }

    private function overlayHtmlImage($type, $val): string
    {
        return sprintf(
            '<img src="%s/%s_%s.png" style="position:absolute;top:0;left:0;z-index:1" />',
            $this->images,
            $type,
            strtolower($val)
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
            $this->images
        );
        $label .= $this->overlayCssImage('fuel', $this->tyre->getFuel());
        $label .= $this->overlayCssImage('wet', $this->tyre->getWet());
        $label .= $this->overlayCssImage('db', $this->tyre->getNoiseDb());
        $label .= $this->overlayCssImage('sw', $this->tyre->getNoiseClass());
        $label .= '</div>';

        return $label;
    }

    /**
     * Generates a PNG label from the component parts found in the images directory.
     */
    public function genPngLabel()
    {
        $image = imagecreatefrompng(
            sprintf(
                '%s/bg.png',
                $this->images_dir
            )
        );

        $image = $this->overlayGdImage('fuel', $this->fuel, $image);
        $image = $this->overlayGdImage('wet', $this->wet, $image);
        $image = $this->overlayGdImage('db', $this->noise_db, $image);

        return $this->overlayGdImage('sw', $this->sw, $image);
    }

    private function overlayHtmlImage($type, $val): string
    {
        return sprintf(
            '<img src="%s/%s_%s.png" style="position:absolute;top:0;left:0;z-index:1" />',
            $this->images,
            $type,
            strtolower($val)
        );
    }

    private function overlayCssImage(string $type, string $val): string
    {
        return sprintf(
            '<img src="%s/%s_%s.png" class="tyre-label-overlay" />',
            $this->images,
            $type,
            strtolower($val)
        );
    }

    /**
     * Method used for building the over layed image by taking arguments for which
     * variables and thereby which images to use.
     */
    private function overlayGdImage(string $type, string $val, string $image)
    {
        $src = imagecreatefrompng(
            sprintf(
                '%s/%s_%s.png',
                $this->images_dir,
                $type,
                strtolower($val)
            )
        );

        imagecopy($image, $src, 0, 0, 0, 0, imagesx($src), imagesy($src));

        return $image;
    }
}
