<?php


namespace AmpedWeb\GlideInABox\Can;

use AmpedWeb\GlideInABox\Exceptions\InvalidFlipException;
use AmpedWeb\GlideInABox\Interfaces\Flip;

/**
 * Trait Flip
 *
 * @property array $buildParams
 *
 * @see https://glide.thephpleague.com/1.0/api/flip/
 * @package AmpedWeb\GlideInABox\Can
 */
trait HasFlip
{
    /**
     * Flip the image
     *
     * @param string $flip One of:
     *                     - 'both',
     *                     - 'h',
     *                     - 'v'.
     *                     Or you can use the interface constants:
     *                     - Flip::BOTH
     *                     - FLip::HORIZONTAL
     *                     - Flip::VERTICAL
     *
     * @return $this
     * @throws InvalidFlipException
     */
    public function flip(string $flip)
    {
        if ($flip !== Flip::BOTH &&
            $flip !== Flip::HORIZONTAL &&
            $flip !== Flip::VERTICAL
        ) {
            throw new InvalidFlipException();
        }

        $this->buildParams['flip'] = $flip;

        return $this;
    }
}