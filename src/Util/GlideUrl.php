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
    protected function parsedPath()
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
     * @param       $presets
     * @param array $params
     *
     * @return mixed
     */
    public function preset($presets, array $params = [])
    {
        return url($this->urlFactory->getUrl($this->parsedPath(), array_merge($this->parsePresets($presets), $params)));
    }

    /**
     * @param array $params
     *
     * @return mixed
     */
    public function custom(array $params = [])
    {

        return url($this->urlFactory->getUrl($this->parsedPath(), $params));
    }

}