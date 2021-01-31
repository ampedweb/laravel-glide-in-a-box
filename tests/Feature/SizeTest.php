<?php


namespace AmpedWeb\GlideInABox\Tests\Feature;


use AmpedWeb\GlideInABox\Exceptions\InvalidSizeFitException;
use AmpedWeb\GlideInABox\Tests\TestCase;
use AmpedWeb\GlideInABox\Traits\Size;
use AmpedWeb\GlideInABox\Util\GlideUrl;
use function glide_url;

class SizeTest extends TestCase
{
    /** @var GlideUrl */
    protected $glide;

    public function setUp(): void
    {
        parent::setUp();

        $this->glide = glide_url('foo');
    }

    public function testFitRejectsInvalidInput()
    {
        $this->expectException(InvalidSizeFitException::class);
        $this->glide->fit('foo');
    }

    public function testFitSetsCorrectContainValue()
    {
        $this->glide->fit(Size::$FIT_CONTAIN);
        $this->assertEquals('contain', $this->glide->getParams()['fit']);
    }

    public function testFitSetsCorrectMaxValue()
    {
        $this->glide->fit(Size::$FIT_MAX);
        $this->assertEquals('max', $this->glide->getParams()['fit']);
    }

    public function testFitSetsCorrectFillValue()
    {
        $this->glide->fit(Size::$FIT_FILL);
        $this->assertEquals('fill', $this->glide->getParams()['fit']);
    }

    public function testFitSetsCorrectStretchValue()
    {
        $this->glide->fit(Size::$FIT_STRETCH);
        $this->assertEquals('stretch', $this->glide->getParams()['fit']);
    }

    public function testFitSetsCorrectCropValue()
    {
        $this->glide->fit(Size::$FIT_CROP);
        $this->assertEquals('crop', $this->glide->getParams()['fit']);
    }

    public function testFitIsFluent()
    {
        $this->assertEquals($this->glide, $this->glide->fit(Size::$FIT_CROP));
    }

    public function testWidthSetsCorrectValue()
    {
        $this->glide->width(50);
        $this->assertEquals(50, $this->glide->getParams()['w']);
    }

    public function testWidthIsFluent()
    {
        $this->assertEquals($this->glide, $this->glide->width(50));
    }

    public function testHeightSetsCorrectValue()
    {
        $this->glide->height(100);
        $this->assertEquals(100, $this->glide->getParams()['h']);
    }

    public function testHeightIsFluent()
    {
        $this->assertEquals($this->glide, $this->glide->height(100));
    }

    public function testSizeSetsCorrectValues()
    {
        $this->glide->size(320,240);
        $this->assertEquals(320, $this->glide->getParams()['w']);
        $this->assertEquals(240, $this->glide->getParams()['h']);
    }

    public function testSizeIsFluent()
    {
        $this->assertEquals($this->glide, $this->glide->size(320, 240));
    }
}