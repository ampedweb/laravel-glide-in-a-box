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
        if ($flip !== \AmpedWeb\GlideInABox\Interfaces\Flip::BOTH &&
            $flip !== \AmpedWeb\GlideInABox\Interfaces\Flip::HORIZONTAL &&
            $flip !== \AmpedWeb\GlideInABox\Interfaces\Flip::VERTICAL
        ) {
            throw new InvalidFlipException();
        }

        $this->buildParams['flip'] = $flip;

        return $this;
    }
}