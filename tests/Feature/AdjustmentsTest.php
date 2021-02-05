<?php


namespace AmpedWeb\GlideInABox\Tests\Feature;


use AmpedWeb\GlideInABox\Tests\TestCase;
use AmpedWeb\GlideInABox\Util\GlideUrl;

class AdjustmentsTest extends TestCase
{
    /** @var GlideUrl */
    protected $glideUrl;

    public function setUp(): void
    {
        parent::setUp();
        $this->glideUrl = glide_url('cat.png');
    }

    public function testBriIsFluent()
    {
        $this->assertEquals($this->glideUrl, $this->glideUrl->bri(1));
    }

    public function testConIsFluent()
    {
        $this->assertEquals($this->glideUrl, $this->glideUrl->con(5));
    }

    public function testGamIsFluent()
    {
        $this->assertEquals($this->glideUrl, $this->glideUrl->gam(2.3));
    }

    public function testSharpIsFluent()
    {
        $this->assertEquals($this->glideUrl, $this->glideUrl->sharp(4));
    }

    public function testBriSetsCorrectValues()
    {
        $this->glideUrl->bri(4);
        $this->assertEquals(4, $this->glideUrl->getParams()['bri']);
    }

    public function testConSetsCorrectValues()
    {
        $this->glideUrl->con(6);
        $this->assertEquals(6, $this->glideUrl->getParams()['con']);
    }

    public function testGamSetsCorrectValues()
    {
        $this->glideUrl->gam(6.4);
        $this->assertEquals(6.4, $this->glideUrl->getParams()['gam']);
    }

    public function testSharpSetsCorrectValues()
    {
        $this->glideUrl->sharp(45);
        $this->assertEquals(45, $this->glideUrl->getParams()['sharp']);
    }

    public function testBriFlattensOutOfRangeValues()
    {
        $this->glideUrl->bri(-999);
        $this->assertEquals(-100, $this->glideUrl->getParams()['bri']);

        $this->glideUrl->bri(999);
        $this->assertEquals(100, $this->glideUrl->getParams()['bri']);
    }

    public function testConFlattensOutOfRangeValues()
    {
        $this->glideUrl->con(-999);
        $this->assertEquals(-100, $this->glideUrl->getParams()['con']);

        $this->glideUrl->con(999);
        $this->assertEquals(100, $this->glideUrl->getParams()['con']);
    }

    public function testGamFlattensOutOfRangeValues()
    {
        $this->glideUrl->gam(-5);
        $this->assertEquals(0.1, $this->glideUrl->getParams()['gam']);

        $this->glideUrl->gam(999);
        $this->assertEquals(9.99, $this->glideUrl->getParams()['gam']);
    }

    public function testSharpFlattensOutOfRangeValues()
    {
        $this->glideUrl->sharp(-999);
        $this->assertEquals(0, $this->glideUrl->getParams()['sharp']);

        $this->glideUrl->sharp(999);
        $this->assertEquals(100, $this->glideUrl->getParams()['sharp']);
    }

    public function testBrightnessIsAnAliasOfBri()
    {
        $this->assertSame($this->glideUrl->brightness(45), $this->glideUrl->bri(45));
    }

    public function testContrastIsAnAliasOfCon()
    {
        $this->assertSame($this->glideUrl->contrast(45), $this->glideUrl->con(45));
    }

    public function testSharpenIsAnAliasOfSharp()
    {
        $this->assertSame($this->glideUrl->sharpen(45), $this->glideUrl->sharp(45));
    }
}