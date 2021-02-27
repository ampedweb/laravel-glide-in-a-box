<?php


namespace AmpedWeb\GlideInABox\Can;

use AmpedWeb\GlideInABox\Exceptions\InvalidCropPositionException;
use AmpedWeb\GlideInABox\Interfaces\Crop;

/**
 * This trait exposes image cropping functionality.
 *
 * @property array $buildParams
 *
 * @link     https://glide.thephpleague.com/1.0/api/crop/
 * @package AmpedWeb\GlideInABox\Can
 */
trait HasCrop
{
    /**
     * Resizes the image to fill the width and height boundaries.  Crops any excess image data.
     *
     * The resulting image will match the width and height constraints without distorting the image.
     *
     * This is the equivalent of `fit=crop`
     *
     * @param int $width
     * @param int $height
     *
     * @return $this
     */
    public function crop(int $width, int $height)
    {
        $this->buildParams['w'] = $width;
        $this->buildParams['h'] = $height;
        $this->buildParams['fit'] = 'crop';

        return $this;
    }

    /**
     * Crop and specify the crop position.
     *
     * Default is `crop-center` and is the same as crop.
     *
     * @param int    $width
     * @param int    $height
     * @param string $position One of:
     *                         - 'crop-top-left',
     *                         - 'crop-top',
     *                         - 'crop-top-right'
     *                         - 'crop-left',
     *                         - 'crop-center',
     *                         - 'crop-right'
     *                         - 'crop-bottom-left',
     *                         - 'crop-bottom',
     *                         - 'crop-bottom-right'.
     *                         Or, you can use one of the handy interface constants:
     *                         - Crop::TOP_LEFT
     *                         - Crop::TOP
     *                         - Crop::TOP_RIGHT
     *                         - Crop::LEFT
     *                         - Crop::CENTER
     *                         - Crop::RIGHT
     *                         - Crop::BOTTOM_LEFT
     *                         - Crop::BOTTOM
     *                         - Crop::BOTTOM_RIGHT
     *
     * @return $this
     * @throws InvalidCropPositionException
     * @see Crop
     */
    public function cropToPosition(int $width, int $height, string $position)
    {
        if ($position !== Crop::TOP_LEFT &&
            $position !== Crop::TOP &&
            $position !== Crop::TOP_RIGHT &&
            $position !== Crop::LEFT &&
            $position !== Crop::CENTER &&
            $position !== Crop::RIGHT &&
            $position !== Crop::BOTTOM_LEFT &&
            $position !== Crop::BOTTOM &&
            $position !== Crop::BOTTOM_RIGHT
        ) {
            throw new InvalidCropPositionException();
        }

        $this->buildParams['w'] = $width;
        $this->buildParams['h'] = $height;
        $this->buildParams['fit'] = $position;

        return $this;
    }

    /**
     * Crop the image, specifying an exact focal point with optional zoom.
     *
     * You may also choose to zoom into your focal point by providing value for $zoom.
     * This should be between 1 and 100.  Each full step is the equivalent of a 100% zoom.
     * (eg. `2` is the equivalent of viewing the image at 200%). The suggested range is 1-10.
     *
     * @param int        $width
     * @param int        $height
     * @param int        $x
     * @param int        $y
     * @param float|null $zoom
     *
     * @return $this
     */
    public function cropToFocalPoint(int $width, int $height, int $x, int $y, float $zoom = null)
    {
        $this->buildParams['w'] = $width;
        $this->buildParams['h'] = $height;

        $crop = sprintf('crop-%s-%s', $x, $y);

        if ($zoom !== null) {
            $zoom = max(1, $zoom);
            $zoom = min(100, $zoom);
            $crop = sprintf('%s-%s', $crop, $zoom);
        }

        $this->buildParams['fit'] = $crop;

        return $this;
    }

    /**
     * Crop the image to specific dimensions before any other resize operations
     *
     * The top-left corner of the crop is specified as ($x, $y).
     *
     * @param int $width
     * @param int $height
     * @param int $x X ordinate of crop origin
     * @param int $y Y ordinate of crop origin
     *
     * @return $this
     */
    public function cropToBoundingBox(int $width, int $height, int $x, int $y)
    {
        $this->buildParams['crop'] = sprintf('%s,%s,%s,%s', $width, $height, $x, $y);

        return $this;
    }
}