<?php


namespace AmpedWeb\GlideInABox\Util;


use AmpedWeb\GlideInABox\Can\HasAdjustments;
use AmpedWeb\GlideInABox\Can\HasBackground;
use AmpedWeb\GlideInABox\Can\HasBorder;
use AmpedWeb\GlideInABox\Can\HasCrop;
use AmpedWeb\GlideInABox\Can\HasEffects;
use AmpedWeb\GlideInABox\Can\HasEncode;
use AmpedWeb\GlideInABox\Can\HasFlip;
use AmpedWeb\GlideInABox\Can\HasOrientation;
use AmpedWeb\GlideInABox\Can\HasPixelDensity;
use AmpedWeb\GlideInABox\Can\HasSize;
use AmpedWeb\GlideInABox\Can\HasWatermarks;
use Illuminate\Support\Str;
use League\Glide\Urls\UrlBuilder;
use League\Glide\Urls\UrlBuilderFactory;

class GlideUrl
{
    use HasOrientation, HasFlip, HasCrop, HasSize, HasPixelDensity, HasAdjustments, HasEffects, HasBorder, HasWatermarks, HasBackground, HasEncode;

    /**
     * The filepath of our image being manipulated
     * @var string
     */
    protected $path;

    /**
     * @var UrlBuilder
     */
    protected $urlFactory;

    /**
     * @var array
     */
    protected $buildParams;

    /**
     * GlideUrl constructor.
     */
    public function __construct()
    {
        $this->urlFactory = UrlBuilderFactory::create('/' . config('glideinabox.base_url') . '/', config('glideinabox.signature_key'));
        $this->buildParams = [];
    }


    /**
     * @param string $path
     *
     * @return GlideUrl
     */
    public function setPath(string $path): GlideUrl
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParsedPath()
    {
        if (Str::startsWith($this->path, '/storage/')) {
            $this->path = Str::replaceFirst('/storage/', '', $this->path);
        }

        return Str::of($this->path)->replace('\\', '/');
    }

    /**
     * Parse either single or multiple presets
     *
     * @param $presets
     *
     * @return array
     */
    protected function parsePresets($presets)
    {

        if (is_array($presets)) {
            return ['p' => implode(',', $presets)];
        }

        return ['p' => $presets];

    }

    /**
     * Start building an image URL based on a preset
     *
     * @param       $presets
     * @param array $params
     *
     * @return GlideUrl
     */
    public function preset($presets, array $params = []): GlideUrl
    {
        $this->buildParams = array_merge($this->parsePresets($presets), $params);
        return $this;
    }

    /**
     * @param array $params
     *
     * @return mixed
     */
    public function custom(array $params = [])
    {

        return url($this->urlFactory->getUrl($this->getParsedPath(), $params));
    }

    /*
     * Fluent Interface Functions
     */


    /**
     * Start building an image configuration
     *
     * @return $this
     */
    public function build(): GlideUrl
    {
        $this->buildParams = [];

        return $this;
    }

    /**
     * Get the URL to your image after building the configuration
     *
     * @return string
     */
    public function url(): string
    {
        return url($this->urlFactory->getUrl($this->getParsedPath(), $this->buildParams));
    }

    /**
     * Get the current set of image builder parameters
     *
     * @return array
     */
    public function getParams(): array
    {
        return $this->buildParams;
    }
}