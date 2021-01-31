<?php


namespace AmpedWeb\GlideInABox\Tests;


use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ImageTestCase extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $testImageFile = __DIR__ . '/fixtures/cat.png';
        $this->assertFileExists($testImageFile);
        $testImageFile = new File($testImageFile);
        Storage::putFileAs('/public', $testImageFile, 'cat.png');
    }
}