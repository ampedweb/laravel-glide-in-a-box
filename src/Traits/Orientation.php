<?php


namespace AmpedWeb\GlideInABox\Traits;

use AmpedWeb\GlideInABox\Exceptions\InvalidOrientationException;

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
     *                            - Orientation::$ORIENTATION_AUTO
     *                            - Orientation::$ORIENTATION_0
     *                            - Orientation::$ORIENTATION_90
     *                            - Orientation::$ORIENTATION_180
     *                            - Orientation::$ORIENTATION_270
     *
     * @return $this
     * @throws InvalidOrientationException
     */
    public function orientation(string $orientation)
    {
        if ($orientation !== static::$ORIENTATION_AUTO &&
            $orientation !== static::$ORIENTATION_0 &&
            $orientation !== static::$ORIENTATION_90 &&
            $orientation !== static::$ORIENTATION_180 &&
            $orientation !== static::$ORIENTATION_270
        ) {
            throw new InvalidOrientationException();
        }

        $this->buildParams['or'] = $orientation;

        return $this;
    }
}