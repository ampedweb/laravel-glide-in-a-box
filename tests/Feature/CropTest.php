<?php


namespace AmpedWeb\GlideInABox\Tests\Feature;


use AmpedWeb\GlideInABox\Exceptions\InvalidCropPositionException;
use AmpedWeb\GlideInABox\Tests\TestCase;
use AmpedWeb\GlideInABox\Traits\Crop;
use AmpedWeb\GlideInABox\Util\GlideUrl;

class CropTest extends TestCase
{
    /** @var GlideUrl */
    protected $glideUrl;

    public function setUp(): void
    {
        parent::setUp();
        $this->glideUrl = glide_url('cat.png');
    }

    public function testCropIsFluent()
    {
        $this->assertEquals($this->glideUrl, $this->glideUrl->crop(20, 30));
    }

    public function testCropSetsCorrectValues()
    {
        $this->glideUrl->crop(100, 200);
        $this->assertEquals(100, $this->glideUrl->getParams()['w']);
        $this->assertEquals(200, $this->glideUrl->getParams()['h']);
        $this->assertEquals('crop', $this->glideUrl->getParams()['fit']);
    }

    public function testCropToPositionRejectsInvalidInput()
    {
        $invalidInput = 'foo';

        $this->expectException(InvalidCropPositionException::class);
        $this->glideUrl->cropToPosition(1, 2, $invalidInput);
    }

    public function testCropToPositionIsFluent()
    {
        $this->assertEquals($this->glideUrl, $this->glideUrl->cropToPosition(1, 2, Crop::$CROP_BOTTOM_LEFT));
    }
    
    public function testCropToPositionSetsCorrectValues()
    {
        $this->glideUrl->cropToPosition(100, 200, Crop::$CROP_BOTTOM_LEFT);
        $this->assertEquals('crop-bottom-left', $this->glideUrl->getParams()['fit']);
        $this->assertEquals(100, $this->glideUrl->getParams()['w']);
        $this->assertEquals(200, $this->glideUrl->getParams()['h']);
    }

    public function testCropToFocalPointIsFluent()
    {
        $this->assertEquals($this->glideUrl, $this->glideUrl->cropToFocalPoint(100, 200, 30, 40));
    }

    public function testCropToFocalPointSetsCorrectUnzoomedValues()
    {
        $this->glideUrl->cropToFocalPoint(100, 200, 30, 40);
        $this->assertEquals(100, $this->glideUrl->getParams()['w']);
        $this->assertEquals(200, $this->glideUrl->getParams()['h']);
        $this->assertEquals('crop-30-40', $this->glideUrl->getParams()['fit']);
    }

    public function testCropToFocalPointSetsCorrectZoomedValues()
    {
        $this->glideUrl->cropToFocalPoint(100, 200, 30, 40, 50);
        $this->assertEquals(100, $this->glideUrl->getParams()['w']);
        $this->assertEquals(200, $this->glideUrl->getParams()['h']);
        $this->assertEquals('crop-30-40-50', $this->glideUrl->getParams()['fit']);
    }

    public function testCropToFocalPointClampsZoomValue()
    {
        $this->glideUrl->cropToFocalPoint(100, 200, 30, 40, 500);

        $this->assertEquals(100, $this->glideUrl->getParams()['w']);
        $this->assertEquals(200, $this->glideUrl->getParams()['h']);
        $this->assertEquals('crop-30-40-100', $this->glideUrl->getParams()['fit']);

        $this->glideUrl->cropToFocalPoint(100, 200, 30, 40, -500);

        $this->assertEquals(100, $this->glideUrl->getParams()['w']);
        $this->assertEquals(200, $this->glideUrl->getParams()['h']);
        $this->assertEquals('crop-30-40-1', $this->glideUrl->getParams()['fit']);
    }

    public function testCropToBoundingBoxIsFluent()
    {
        $this->assertEquals($this->glideUrl, $this->glideUrl->cropToBoundingBox(10, 20, 30, 40));
    }

    public function testCropToBoundingBoxSetsCorrectValues()
    {
        $this->glideUrl->cropToBoundingBox(10, 20, 30, 40);

        $this->assertEquals('10,20,30,40', $this->glideUrl->getParams()['crop']);
    }
}