<?php
/**
 * This was built for dynamically creating EU Tyre Label
 * graphics for use on the web. It can use a number of different
 * methods dependent on your needs. Each method is documented and I'd
 * advise reading the code ocs as well as the readme for a deeper
 * understanding of what's possible with the class.
 *
 * @author Doug Bromley <doug@tintophat.com>
 * @copyright Doug Bromley
 * @link https://github.com/OdinsHat/tyre-label-generator
 * @license BSD
 */

class TyreLabel
{
    private $images_dir;
    private $fuel;
    private $wet;
    private $noise_db;
    private $noise_class;

    /**
     * Initialise the class with the tyre label parameters and the folder
     * of where the tyre label images are kept so they can be used as the
     * building blocks.
     *
     * @param char  $fuel           the fuel economy class e.g. A, B, C, D...
     * @param char  $wet            the wet grip class e.g. A, B, C, D
     * @param int   $noise_db       the noise level in decibels (e.g. 72)
     * @param int   $noise_class    the number of noise waves on the image 1, 2 or 3
     * @param int   $height         the height override for the image
     * @param string $images        the directory where the images are stored which
     *                              defaults to the /images dir from web root.
     *
     * @todo add validation to given parameters
     */
    public function __construct($fuel, $wet, $noise_db, $noise_class, $height = 280, $images = '/images')
    {
        $this->images_dir = $images;
        $this->fuel = strtolower($fuel);
        $this->wet = strtolower($wet);
        $this->noise_db = $noise_db;
        $this->sw = $noise_class;
    }

    /**
     * Generates a Tyre Label using inline CSS
     *
     * This isn't the recommended method but it is the easiest if you want to
     * get a quick & dirty tyre label up.
     *
     * @return string HTML of the tyre label images overlaid on each other
     */
    public function genHtmlLabel()
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

    private function overlayHtmlImage($type, $val)
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
    public function genCssLabel()
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

    private function overlayCssImage($type, $val)
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

    }
}
