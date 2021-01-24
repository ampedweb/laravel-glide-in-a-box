<?php


namespace AmpedWeb\GlideInABox\Traits;

use AmpedWeb\GlideInABox\Exceptions\InvalidFlipException;

/**
 * Trait Flip
 *
 * @property array $buildParams
 *
 * @see https://glide.thephpleague.com/1.0/api/flip/
 * @package AmpedWeb\GlideInABox\Traits
 */
trait Flip
{
    public static $FLIP_BOTH = 'both';
    public static $FLIP_H = 'h';
    public static $FLIP_V = 'v';

    /**
     * Flip the image
     *
     * @param string $flip One of:
     *                     - 'both',
     *                     - 'h',
     *                     - 'v'.
     *                     Or you can use a static variable:
     *                     - Flip::$FLIP_BOTH
     *                     - FLip::$FLIP_H
     *                     - Flip::$FLIP_V
     *
     * @return $this
     * @throws InvalidFlipException
     */
    public function flip(string $flip)
    {
        if ($flip !== static::$FLIP_BOTH &&
            $flip !== static::$FLIP_H &&
            $flip !== static::$FLIP_V
        ) {
            throw new InvalidFlipException();
        }

        $this->buildParams['flip'] = $flip;

        return $this;
    }
}