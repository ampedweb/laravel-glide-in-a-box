<?php


namespace AmpedWeb\GlideInABox\Tests\Feature;


use League\Glide\Urls\UrlBuilder;
use League\Glide\Signatures\Signature;
use AmpedWeb\GlideInABox\Providers\PackageServiceProvider;
use AmpedWeb\GlideInABox\Tests\TestCase;
use AmpedWeb\GlideUrl\FluentUrlBuilder;
use Config;
use League\Flysystem\Filesystem;
use League\Glide\Api\Api;
use League\Glide\Manipulators\Watermark;
use League\Glide\Server;
use AmpedWeb\GlideInABox\Services\GlideSignatureValidationService;

class GlideServerServiceProviderTest extends TestCase
{
    public function testWatermarksConfigurationIsParsed()
    {
        $watermarkPath = 'foo';
        $watermarkPathPrefix = 'bar';

        Config::set('glideinabox.watermarks', $watermarkPath);
        Config::set('glideinabox.watermarks_path_prefix', $watermarkPathPrefix);

        $server = $this->app->make(Server::class);


        // This is completely sketchy.  Server::getApi() returns an
        // instance of ApiInterface.  But we believe strongly that
        // it will always be an instance of Api.  Therefore we are
        // going to rely on concretions instead of abstractions.
        // I feel so dirty about this.

        $api = $server->getApi();

        // Still, at least we can assert its type.  Small consolation.
        $this->assertInstanceOf(Api::class, $api);

        $manipulators = $api->getManipulators();

        $watermarkManipulator = null;
        foreach ($manipulators as $key => $value) {
            if ($value instanceof Watermark) {
                $watermarkManipulator = $value;
            }
        }

        $this->assertInstanceOf(Watermark::class, $watermarkManipulator);

        $this->assertEquals($watermarkPathPrefix, $watermarkManipulator->getWatermarksPathPrefix());

        /** @var Filesystem $watermarksFlysystem */
        $watermarksFlysystem = $watermarkManipulator->getWatermarks();
        $this->assertInstanceOf(Filesystem::class, $watermarksFlysystem);

        /* Clean up created directory.  Yes, really. */
        rmdir(__DIR__ . '/../../foo');
    }

    public function testMakeFluentUrlBuilderBinding()
    {
        $glideUrl = $this->app->make(FluentUrlBuilder::class);

        $this->assertInstanceOf(FluentUrlBuilder::class, $glideUrl);
    }

    public function testServiceProvidesServer()
    {
        $service = new PackageServiceProvider($this->app);

        $expected = [
            Server::class,
            FluentUrlBuilder::class,
            UrlBuilder::class,
            Signature::class,
            GlideSignatureValidationService::class,
        ];

        $this->assertEqualsCanonicalizing($expected, $service->provides());
    }
}