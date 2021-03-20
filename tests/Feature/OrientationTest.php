<?php


namespace AmpedWeb\GlideInABox\Tests\Feature;


use AmpedWeb\GlideInABox\Exceptions\InvalidOrientationException;
use AmpedWeb\GlideInABox\Tests\ImageTestCase;
use AmpedWeb\GlideInABox\Can\HasOrientation;
use AmpedWeb\GlideInABox\Util\GlideUrl;

class OrientationTest extends ImageTestCase
{
    /** @var GlideUrl */
    protected $glideUrl;

    public function setUp(): void
    {
        parent::setUp();

        $this->glideUrl = glide_url('cat.png');
    }

    public function testOrientationRejectsInvalidInput()
    {
        $invalidInput = 'foo';

        $this->expectException(InvalidOrientationException::class);
        $this->glideUrl->orientation($invalidInput);
    }

    public function testOrientationIsFluent()
    {
        $glideUrl = $this->glideUrl->orientation(HasOrientation::$ORIENTATION_AUTO);
        $this->assertEquals($this->glideUrl, $glideUrl);
    }

    public function testOrientationSetsCorrectValueAuto()
    {
        $this->glideUrl->orientation(HasOrientation::$ORIENTATION_AUTO);
        $this->assertEquals('auto', $this->glideUrl->getParams()['or']);
    }

    public function testOrientationSetsCorrectValue0()
    {
        $this->glideUrl->orientation(HasOrientation::$ORIENTATION_0);
        $this->assertEquals('0', $this->glideUrl->getParams()['or']);
    }

    public function testOrientationSetsCorrectValue90()
    {
        $this->glideUrl->orientation(HasOrientation::$ORIENTATION_90);
        $this->assertEquals('90', $this->glideUrl->getParams()['or']);
    }

    public function testOrientationSetsCorrectValue180()
    {
        $this->glideUrl->orientation(HasOrientation::$ORIENTATION_180);
        $this->assertEquals('180', $this->glideUrl->getParams()['or']);
    }

    public function testOrientationSetsCorrectValue270()
    {
        $this->glideUrl->orientation(HasOrientation::$ORIENTATION_270);
        $this->assertEquals('270', $this->glideUrl->getParams()['or']);
    }
}