<?php


namespace AmpedWeb\GlideInABox\Traits;

use AmpedWeb\GlideInABox\Exceptions\InvalidOrientationException;
use AmpedWeb\GlideInABox\Interfaces\Rotate;

/**
 * Trait Orientation
 *
 * @property array $buildParams
 *
 * @see     https://glide.thephpleague.com/1.0/api/orientation/
 * @package AmpedWeb\GlideInABox\Traits
 */
trait Orientation
{
    public static $ORIENTATION_AUTO = 'auto';
    public static $ORIENTATION_0 = '0';
    public static $ORIENTATION_90 = '90';
    public static $ORIENTATION_180 = '180';
    public static $ORIENTATION_270 = '270';

    /**
     * Rotate the image/set image orientation.  Default value is `auto`.
     *
     * The `auto` option uses Exif data to decide on orientation.
     *
     * @param string $orientation One of:
     *                            - 'auto'
     *                            - '0'
     *                            - '90'
     *                            - '180'
     *                            - '270'.
     *                            Or you can use one of the convenient static variables:
     *                            - Rotate::AUTO
     *                            - Rotate::R0
     *                            - Rotate::R90
     *                            - Rotate::R180
     *                            - Rotate::R270
     *
     * @return $this
     * @throws InvalidOrientationException
     */
    public function orientation(string $orientation)
    {
        if ($orientation !== Rotate::AUTO &&
            $orientation !== Rotate::R0 &&
            $orientation !== Rotate::R90 &&
            $orientation !== Rotate::R180 &&
            $orientation !== Rotate::R270
        ) {
            throw new InvalidOrientationException();
        }

        $this->buildParams['or'] = $orientation;

        return $this;
    }
}