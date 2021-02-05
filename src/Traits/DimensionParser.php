<?php


namespace AmpedWeb\GlideInABox\Traits;


use AmpedWeb\GlideInABox\Exceptions\InvalidDimensionException;

/**
 * This trait parses relative dimensions.
 *
 * @link https://glide.thephpleague.com/1.0/api/relative-dimensions/
 * @package AmpedWeb\GlideInABox\Traits
 */
trait DimensionParser
{
    /**
     * @property array $buildParams
     */

    /**
     * Identify a relative dimension
     * 
     * @param $dimension
     *
     * @return bool
     */
    protected function dimensionIsRelative($dimension)
    {
        $dimensionRegex = '/^[0-9]+[wh]$/';

        return (preg_match($dimensionRegex, $dimension) > 0);
    }

    /**
     * Identify a numeric value
     *
     * @param $value
     *
     * @return bool
     */
    protected function valueIsNumber($value)
    {
        $numberRegex = '/^\-?[0-9]+$/';

        return (preg_match($numberRegex, $value) > 0);
    }

    /**
     * Parse a relative dimension
     *
     * @param $dimension
     *
     * @return string  0-100(w|h)
     */
    protected function parseRelativeDimension($dimension)
    {
        $numberRegex = '/^([0-9]+)/';

        $number = [];
        preg_match($numberRegex, $dimension, $number);

        $number = current($number);

        $axisRegex = '/(w|h)/';

        $axis = [];
        preg_match($axisRegex, $dimension, $axis);

        $axis = current($axis);

        $number = max(0, $number);
        $number = min(100, $number);

        return sprintf('%s%s', $number, $axis);
    }

    /**
     * Parse either an absolute or relative dimension.
     *
     * Absolute dimensions are clamped to positive numbers.
     * Relative dimension are contained within the range 0-100.
     *
     * If the provided $dimension is neither an integer nor a valid
     * relative dimension, an InvalidDimensionException is thrown.
     *
     * @param $dimension
     *
     * @return int|string
     * @throws InvalidDimensionException
     */
    protected function parseDimension($dimension)
    {
        if ($this->dimensionIsRelative($dimension)) {
            return $this->parseRelativeDimension($dimension);
        }

        if ($this->valueIsNumber($dimension)) {
            return (int)abs($dimension);
        }

        throw new InvalidDimensionException();
    }
}