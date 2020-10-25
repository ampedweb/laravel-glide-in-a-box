<?php


namespace AmpedWeb\GlideInABox\Tests\Feature;


use AmpedWeb\GlideInABox\Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Intervention\Image\Facades\Image;

class ImageResponseTest extends TestCase
{

    protected function putImage()
    {
        $testImageFile = __DIR__ . '/../fixtures/cat.png';
        $this->assertFileExists($testImageFile);
        $testImageFile = new File($testImageFile);
        Storage::putFileAs('/public', $testImageFile, 'cat.png');
    }

    public function testCustomImageResponse()
    {

        $this->putImage();

        $glideUrl = glide_url('cat.png')->custom(['w' => 200]);

        $imgResponse = $this->get($glideUrl);

        //Perform a few checks about the image
        $imgResponse->assertOk();
        $imgResponse->assertHeader('content-type', 'image/png');

    }

    public function testPresetImageResponse()
    {
        $this->putImage();

        $glideUrl = glide_url('cat.png')->preset('large');

        $imgResponse = $this->get($glideUrl);

        //Perform a few checks about the image
        $imgResponse->assertOk();
        $imgResponse->assertHeader('content-type', 'image/png');
    }

    public function testPresetImageResponseWithArray()
    {

        $this->putImage();

        $glideUrl = glide_url('cat.png')->preset(['large']);

        $imgResponse = $this->get($glideUrl);

        //Perform a few checks about the image
        $imgResponse->assertOk();
        $imgResponse->assertHeader('content-type', 'image/png');
    }

    public function testNoSignatureResponse()
    {

        $this->putImage();

        $glideUrl = glide_url('cat.png')->preset(['large']);

        //Lets remove our signature from the URL
        $parsedUrl = parse_url($glideUrl);

        $baseUrl = $parsedUrl['scheme'].'://'.$parsedUrl['host'].$parsedUrl['path'];

        $queries = [];
        parse_str($parsedUrl['query'],$queries);

        unset($queries['s']);

        $noSigUrl = $baseUrl.='?'.http_build_query($queries);

        $imgResponse = $this->get($noSigUrl);

        //As we don't have a signature, make sure we are forbidden from this url
        $imgResponse->assertForbidden();
    }

}