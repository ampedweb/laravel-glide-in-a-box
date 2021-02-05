<?php


namespace AmpedWeb\GlideInABox\Traits;

/**
 * Exposes image "adjustments" functionality
 *
 * @link https://glide.thephpleague.com/1.0/api/adjustments/
 * @package AmpedWeb\GlideInABox\Traits
 */
trait Adjustments
{
    /**
     * @property array $buildParams
     */

    /**
     * Adjusts the image brightness. Use values between -100 and +100, where 0 represents no change.
     *
     * @param int $brightness Brightness - use values between 0 and 100
     */
    public function bri(int $brightness = 0)
    {
        
    }

    /**
     * Adjusts the image contrast. Use values between -100 and +100, where 0 represents no change.
     *
     * @param int $contrast Contrast - use values between 0 and 100
     */
    public function con(int $contrast = 0)
    {
        
    }

    /**
     * Adjusts the image gamma. Use values between 0.1 and 9.99.
     *
     * @param float $gamma Gamma - use values between 0.1 and 9.99
     */
    public function gam(float $gamma = 1.0)
    {
        
    }

    /**
     * Sharpen the image. Use values between 0 and 100.
     *
     * @param int $sharpness Shaprness - use values between 0 and 100
     */
    public function sharp(int $sharpness = 0)
    {
        
    }
}