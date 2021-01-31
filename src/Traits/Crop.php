<?php


namespace AmpedWeb\GlideInABox\Traits;

use AmpedWeb\GlideInABox\Exceptions\InvalidCropPositionException;

/**
 * This trait exposes image cropping functionality.
 *
 * @property array $buildParams
 *
 * @link     https://glide.thephpleague.com/1.0/api/crop/
 * @package AmpedWeb\GlideInABox\Traits
 */
trait Crop
{
    /**
     * @var string Select "top left" crop position
     * @see Crop::cropToPosition()
     */
    public static $CROP_TOP_LEFT = 'crop-top-left';

    /**
     * @var string Select "top centre" crop position
     * @see Crop::cropToPosition()
     */
    public static $CROP_TOP = 'crop-top';

    /**
     * @var string Select "top right" crop position
     * @see Crop::cropToPosition()
     */
    public static $CROP_TOP_RIGHT = 'crop-top-right';

    /**
     * @var string Select "centre left" crop position
     * @see Crop::cropToPosition()
     */
    public static $CROP_LEFT = 'crop-left';

    /**
     * @var string Select "centre" crop position
     * @see Crop::cropToPosition()
     */
    public static $CROP_CENTER = 'crop-center';

    /**
     * @var string Select "centre right" crop position
     * @see Crop::cropToPosition()
     */
    public static $CROP_RIGHT = 'crop-right';

    /**
     * @var string Select "bottom left" crop position
     * @see Crop::cropToPosition()
     */
    public static $CROP_BOTTOM_LEFT = 'crop-bottom-left';

    /**
     * @var string Select "bottom centre" crop position
     * @see Crop::cropToPosition()
     */
    public static $CROP_BOTTOM = 'crop-bottom';

    /**
     * @var string Select "bottom right" crop position
     * @see Crop::cropToPosition()
     */
    public static $CROP_BOTTOM_RIGHT = 'crop-bottom-right';

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
     *                         Or, you can use one of the handy static variables:
     *                         - Crop::$CROP_TOP_LEFT
     *                         - Crop::$CROP_TOP
     *                         - Crop::$CROP_TOP_RIGHT
     *                         - Crop::$CROP_LEFT
     *                         - Crop::$CROP_CENTER
     *                         - Crop::$CROP_RIGHT
     *                         - Crop::$CROP_BOTTOM_LEFT
     *                         - Crop::$CROP_BOTTOM
     *                         - Crop::$CROP_BOTTOM_RIGHT
     *
     * @return $this
     * @throws InvalidCropPositionException
     */
    public function cropToPosition(int $width, int $height, string $position)
    {
        if ($position !== static::$CROP_TOP_LEFT &&
            $position !== static::$CROP_TOP &&
            $position !== static::$CROP_TOP_RIGHT &&
            $position !== static::$CROP_LEFT &&
            $position !== static::$CROP_CENTER &&
            $position !== static::$CROP_RIGHT &&
            $position !== static::$CROP_BOTTOM_LEFT &&
            $position !== static::$CROP_BOTTOM &&
            $position !== static::$CROP_BOTTOM_RIGHT
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