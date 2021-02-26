<?php


namespace AmpedWeb\GlideInABox\Traits;

use AmpedWeb\GlideInABox\Exceptions\InvalidFitException;
use AmpedWeb\GlideInABox\Exceptions\InvalidSizeFitException;
use AmpedWeb\GlideInABox\Interfaces\Fit;

/**
 * This trait exposes image sizing functionality.
 *
 * @property array $buildParams
 *
 * @link     https://glide.thephpleague.com/1.0/api/size/
 * @package AmpedWeb\GlideInABox\Traits
 */
trait Size
{
    /**
     * Sets how the image is fitted to its target dimensions.
     *
     * @param string $option This can be any of:
     *                       - 'contain',
     *                       - 'max',
     *                       - 'fill',
     *                       - 'stretch',
     *                       - 'crop'.
     *                       There are also the handy constants on the Fit interface which are acceptable:
     *                       - Fit::CONTAIN,
     *                       - Fit::MAX,
     *                       - Fit::FILL,
     *                       - Fit::STRETCH,
     *                       - Fit::CROP
     *
     * @see \AmpedWeb\GlideInABox\Interfaces\Fit
     *
     * @return $this
     * @throws InvalidFitException
     */
    public function fit(string $option)
    {
        if ($option !== Fit::CONTAIN &&
            $option !== Fit::CROP &&
            $option !== Fit::FILL &&
            $option !== Fit::MAX &&
            $option !== Fit::STRETCH) {
            throw new InvalidFitException();
        }

        $this->buildParams['fit'] = $option;

        return $this;
    }

    /**
     * Sets the width of the image, in pixels.
     *
     * @param int $width
     *
     * @return $this
     */
    public function width(int $width)
    {
        $this->buildParams['w'] = $width;

        return $this;
    }

    /**
     * Sets the height of the image, in pixels.
     *
     * @param int $height
     *
     * @return $this
     */
    public function height(int $height)
    {
        $this->buildParams['h'] = $height;

        return $this;
    }

    /**
     * Sets the width and height of the image, in pixels.
     *
     * @param int $width
     * @param int $height
     *
     * @return Size|\AmpedWeb\GlideInABox\Util\GlideUrl
     */
    public function size(int $width, int $height)
    {
        return $this->width($width)->height($height);
    }
}