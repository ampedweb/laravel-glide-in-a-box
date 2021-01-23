<?php


namespace AmpedWeb\GlideInABox\Tests\Feature;


use AmpedWeb\GlideInABox\Tests\TestCase;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ImageFormatTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $testImageFile = __DIR__ . '/../fixtures/cat.png';
        $this->assertFileExists($testImageFile);
        $testImageFile = new File($testImageFile);
        Storage::putFileAs('/public', $testImageFile, 'cat.png');
    }

    public function testGif()
    {
        $response = $this->get(glide_url('cat.png')->build()->gif()->url());

        $response->assertHeader('content-type', 'image/gif');

        $response->assertOk();
    }

    public function testJpeg()
    {
        $response = $this->get(glide_url('cat.png')->build()->jpeg()->url());

        $response->assertHeader('content-type', 'image/jpeg');

        $response->assertOk();
    }

    public function testPjpeg()
    {
        $response = $this->get(glide_url('cat.png')->build()->pjpeg()->url());

        $response->assertHeader('content-type', 'image/jpeg');

        $response->assertOk();
    }

    public function testPng()
    {
        $response = $this->get(glide_url('cat.png')->build()->png()->url());

        $response->assertHeader('content-type', 'image/png');

        $response->assertOk();
    }

    public function testWebp()
    {
        $response = $this->get(glide_url('cat.png')->build()->webp()->url());

        $response->assertHeader('content-type', 'image/webp');

        $response->assertOk();
    }
}