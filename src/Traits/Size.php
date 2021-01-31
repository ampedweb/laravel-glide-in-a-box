<?php


namespace AmpedWeb\GlideInABox\Traits;

use AmpedWeb\GlideInABox\Exceptions\InvalidSizeFitException;

/**
 * This trait exposes image sizing functionality.
 *
 * @property array $buildParams
 *
 * @link     https://glide.thephpleague.com/1.0/api/size/
 * @package AmpedWeb\GlideInABox\Traits
 */
trait Size
{
    /**
     * @var string Default.  Resize the image to fit within the width and height boundaries without cropping,
     * distorting or altering the aspect ratio.
     *
     * @see fit()
     */
    public static $FIT_CONTAIN = 'contain';

    /**
     * @var string Resizes the image to fit within the width and height boundaries without cropping, distorting or
     *      altering the aspect ratio, and will also not increase the size of the image if it is smaller than the
     *      output size.
     *
     * @see fit()
     */
    public static $FIT_MAX = 'max';

    /**
     * @var string Resizes the image to fit within the width and height boundaries without cropping or distorting the
     *      image, and the remaining space is filled with the background color. The resulting image will match the
     *      constraining dimensions.
     *
     * @see fit()
     */
    public static $FIT_FILL = 'fill';

    /**
     * @var string Stretches the image to fit the constraining dimensions exactly. The resulting image will fill the
     *      dimensions, and will not maintain the aspect ratio of the input image.
     *
     * @see fit()
     */
    public static $FIT_STRETCH = 'stretch';

    /**
     * @var string Resizes the image to fill the width and height boundaries and crops any excess image data. The
     *      resulting image will match the width and height constraints without distorting the image. See the crop page
     *      for more information.
     *
     * @see fit()
     *
     * @see Crop
     */
    public static $FIT_CROP = 'crop';


    /**
     * Sets how the image is fitted to its target dimensions.
     *
     * @param string $option This can be any of:
     *                       - 'contain',
     *                       - 'max',
     *                       - 'fill',
     *                       - 'stretch',
     *                       - 'crop'.
     *                       There are also handy static variables which are acceptable:
     *                       - Size::$FIT_CONTAIN,
     *                       - Size::$FIT_MAX,
     *                       - Size::$FIT_FILL,
     *                       - Size::$FIT_STRETCH,
     *                       - Size::$FIT_CROP
     *
     * @see $FIT_CONTAIN
     * @see $FIT_MAX
     * @see $FIT_FILL
     * @see $FIT_STRETCH
     * @see $FIT_CROP
     *
     * @return $this
     * @throws InvalidSizeFitException
     */
    public function fit(string $option)
    {
        if ($option !== static::$FIT_CONTAIN &&
            $option !== static::$FIT_MAX &&
            $option !== static::$FIT_FILL &&
            $option !== static::$FIT_STRETCH &&
            $option !== static::$FIT_CROP) {
            throw new InvalidSizeFitException();
        }

        $this->buildParams['fit'] = $option;

        return $this;
    }

    /**
     * Sets the width of the image, in pixels.
     *
     * @param int $width
     *
     * @return $this
     */
    public function width(int $width)
    {
        $this->buildParams['w'] = $width;

        return $this;
    }

    /**
     * Sets the height of the image, in pixels.
     *
     * @param int $height
     *
     * @return $this
     */
    public function height(int $height)
    {
        $this->buildParams['h'] = $height;

        return $this;
    }

    /**
     * Sets the width and height of the image, in pixels.
     *
     * @param int $width
     * @param int $height
     *
     * @return Size|\AmpedWeb\GlideInABox\Util\GlideUrl
     */
    public function size(int $width, int $height)
    {
        return $this->width($width)->height($height);
    }
}