<?php


namespace AmpedWeb\GlideInABox\Traits;

use AmpedWeb\GlideInABox\Exceptions\InvalidBorderMethodException;
use AmpedWeb\GlideInABox\Exceptions\InvalidColourException;
use AmpedWeb\GlideInABox\Exceptions\InvalidDimensionException;

/**
 * This trait exposes the image border functionality.
 *
 * @link    https://glide.thephpleague.com/1.0/api/border/
 * @package AmpedWeb\GlideInABox\Traits
 */
trait Border
{
    use ColourParser, DimensionParser;

    /**
     * @property array $buildParams
     */

    /** @var string $BORDERMETHOD_OVERLAY Place border on top of image (default). */
    public static $BORDERMETHOD_OVERLAY = 'overlay';

    /** @var string $BORDERMETHOD_SHRINK Shrink image within border (canvas does not change). */
    public static $BORDERMETHOD_SHRINK = 'shrink';

    /** @var string $BORDERMETHOD_EXPAND Expands canvas to accommodate border. */
    public static $BORDERMETHOD_EXPAND = 'expand';

    /**
     * Add a border to the image.
     *
     * @param $width          string|int Border width.  This can be either a relative dimension (See
     *                        {@link https://glide.thephpleague.com/1.0/api/relative-dimensions/}), in which case the
     *                        value should be a string, or an absolute value, in  which case the value should be an
     *                        integer.
     * @param $colour         string  Sets the colour border.
     *                        See {@link https://glide.thephpleague.com/1.0/api/colors/} for more information on the
     *                        available colour formats.
     * @param $method         string  Sets how the border should be displayed.  Available options:
     *                        - 'overlay': Place border on top of image (default)
     *                        - 'shrink': Shrink image within border (canvas does not change)
     *                        - 'expand': Expands canvas to accommodate border
     *
     *                        These are also available as static strings:
     *                        - Border::$BORDERMETHOD_OVERLAY,
     *                        - Border::$BORDERMETHOD_SHRINK,
     *                        - Border::$BORDERMETHOD_EXPAND
     *
     * @return Border
     * @throws InvalidBorderMethodException
     * @throws InvalidDimensionException
     * @throws InvalidColourException
     * @see DimensionParser::parseDimension()
     */
    public function border($width, $colour, $method = 'overlay')
    {
        if ($method !== static::$BORDERMETHOD_OVERLAY &&
            $method !== static::$BORDERMETHOD_SHRINK &&
            $method !== static::$BORDERMETHOD_EXPAND
        ) {
            throw new InvalidBorderMethodException();
        }

        $this->buildParams['border'] = sprintf(
            '%s,%s,%s',
            $this->parseDimension($width),
            $this->parseColour($colour),
            $method
        );

        return $this;
    }
}