<?php


namespace AmpedWeb\GlideInABox\Traits;

/**
 * This trait exposes pixel density functionality
 *
 * @link    https://glide.thephpleague.com/1.0/api/pixel-density/
 * @package AmpedWeb\GlideInABox\Traits
 */
trait PixelDensity
{
    /**
     * @property array $buildParams
     */

    /**
     * Set the device pixel ratio
     *
     * The device pixel ratio is used to easily convert between CSS pixels and device pixels. This makes it possible to
     * display images at the correct pixel density on a variety of devices such as Apple devices with Retina Displays
     * and Android devices. You must specify either a width, a height, or both for this parameter to work. The default
     * is 1. The maximum value that can be set for $dpr is 8.
     *
     * @param int $ratio dpr - minimum is 1 and maximum is 8
     *
     * @return $this
     */
    public function dpr(int $ratio = 1)
    {
        $ratio = max(1, $ratio);
        $ratio = min(8, $ratio);

        $this->buildParams['dpr'] = $ratio;

        return $this;
    }
}