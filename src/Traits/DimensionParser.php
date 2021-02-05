<?php


namespace AmpedWeb\GlideInABox\Traits;


use AmpedWeb\GlideInABox\Exceptions\InvalidDimensionException;

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
     * @param $value
     *
     * @return bool
     */
    protected function valueIsNumber($value)
    {
        $numberRegex = '/^\-?[0-9]+$/';

        return (preg_match($numberRegex, $value) > 0);
    }

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

    protected function parseDimension($dimension)
    {
        if ($this->dimensionIsRelative($dimension)) {
            return $this->parseRelativeDimension($dimension);
        }

        if ($this->valueIsNumber($dimension)) {
            return abs($dimension);
        }

        throw new InvalidDimensionException();
    }
}