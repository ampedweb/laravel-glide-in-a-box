<?php


namespace AmpedWeb\GlideInABox\Can;

use AmpedWeb\GlideInABox\Exceptions\InvalidFilterException;
use AmpedWeb\GlideInABox\Interfaces\Filter;

/**
 * This trait exposes image effects functionality
 *
 * @link    https://glide.thephpleague.com/1.0/api/effects/
 * @package AmpedWeb\GlideInABox\Can
 */
trait HasEffects
{
    /**
     * @property array $buildParams
     */

    /**
     * Adds a blur effect to the image. Use values between 0 and 100.
     *
     * @param int $blur Blur - use values between 0 and 100
     *
     * @return HasEffects
     */
    public function blur(int $blur = 0)
    {
        $blur = max(0, $blur);
        $blur = min($blur, 100);

        $this->buildParams['blur'] = $blur;

        return $this;
    }

    /**
     * Applies a pixelation effect to the image.  Use values between 0 and 1000.
     *
     * @param int $pixelation Pixelation - use values between 0 and 1000
     *
     * @return HasEffects
     */
    public function pixel(int $pixelation = 0)
    {
        $pixelation = max(0, $pixelation);
        $pixelation = min(1000, $pixelation);

        $this->buildParams['pixel'] = $pixelation;

        return $this;
    }

    /**
     * Applies a pixelation effect to the image.  Use values between 0 and 1000.
     *
     * @param int $pixelation Pixelation - use values between 0 and 1000
     *
     * @return HasEffects|\AmpedWeb\GlideInABox\Util\GlideUrl
     * @see HasEffects::pixel()
     */
    public function pixelate(int $pixelation = 0)
    {
        return $this->pixel($pixelation);
    }

    /**
     * Applies a filter effect to the image.  Accepts greyscale or sepia.
     *
     * @param string $filter Filter to apply.  Acceptable values are:
     *                       - 'greyscale',
     *                       - 'sepia'.
     *
     *                       Or, you can use one of the static strings:
     *                       - Filter::GREYSCALE,
     *                       - Filter::SEPIA
     *
     * @return HasEffects
     * @throws InvalidFilterException
     */
    public function filt(string $filter)
    {
        if ($filter !== Filter::GREYSCALE &&
            $filter !== Filter::SEPIA) {
            throw new InvalidFilterException();
        }

        $this->buildParams['filt'] = $filter;

        return $this;
    }

    /**
     * Applies a filter effect to the image.  Accepts greyscale or sepia.
     *
     * @param string $filter Filter to apply.  Acceptable values are:
     *                       - 'greyscale',
     *                       - 'sepia'.
     *
     *                       Or, you can use one of the static strings:
     *                       - Effects::$FILTER_GREYSCALE,
     *                       - Effects::$FILTER_SEPIA
     *
     * @return HasEffects|\AmpedWeb\GlideInABox\Util\GlideUrl
     * @throws InvalidFilterException
     * @see HasEffects::filt()
     */
    public function filter(string $filter)
    {
        return $this->filt($filter);
    }
}