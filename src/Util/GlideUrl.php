<?php


namespace AmpedWeb\GlideInABox\Util;


use Illuminate\Support\Str;
use League\Glide\Urls\UrlBuilder;
use League\Glide\Urls\UrlBuilderFactory;

class GlideUrl
{

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

    /*
     * Image Format
     */

    public function gif(int $quality = null)
    {
        $this->buildParams['fm'] = 'gif';
        return $this->quality($quality);
    }

    public function jpeg(int $quality = null): GlideUrl
    {
        $this->buildParams['fm'] = 'jpg';
        return $this->quality($quality);
    }

    public function pjpeg(int $quality = null): GlideUrl
    {
        $this->buildParams['fm'] = 'pjpg';
        return $this->quality($quality);
    }

    public function png(int $quality = null): GlideUrl
    {
        $this->buildParams['fm'] = 'png';
        return $this->quality($quality);
    }

    public function webp(int $quality = null): GlideUrl
    {
        $this->buildParams['fm'] = 'webp';
        return $this->quality($quality);
    }

    public function quality(int $quality = null): GlideUrl
    {
        if ($quality !== null) {
            $this->buildParams['q'] = $quality;
        }

        return $this;
    }
}