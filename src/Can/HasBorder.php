<?php


namespace AmpedWeb\GlideInABox\Can;

use AmpedWeb\GlideInABox\Exceptions\InvalidBorderMethodException;
use AmpedWeb\GlideInABox\Exceptions\InvalidColourException;
use AmpedWeb\GlideInABox\Exceptions\InvalidDimensionException;
use AmpedWeb\GlideInABox\Interfaces\Border;

/**
 * This trait exposes the image border functionality.
 *
 * @link    https://glide.thephpleague.com/1.0/api/border/
 * @package AmpedWeb\GlideInABox\Can
 */
trait HasBorder
{
    use HasColourParser, HasDimensionParser;

    /**
     * @property array $buildParams
     */

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
     *                        These are also available as interface constants:
     *                        - Border::$BORDERMETHOD_OVERLAY,
     *                        - Border::$BORDERMETHOD_SHRINK,
     *                        - Border::$BORDERMETHOD_EXPAND
     *
     * @return HasBorder
     * @throws InvalidBorderMethodException
     * @throws InvalidDimensionException
     * @throws InvalidColourException
     * @see HasDimensionParser::parseDimension()
     * @see Border
     */
    public function border($width, $colour, $method = 'overlay')
    {
        if ($method !== Border::OVERLAY &&
            $method !== Border::SHRINK &&
            $method !== Border::EXPAND
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