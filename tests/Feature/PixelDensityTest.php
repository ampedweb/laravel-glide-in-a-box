<?php


namespace AmpedWeb\GlideInABox\Tests\Feature;


use AmpedWeb\GlideInABox\Tests\TestCase;
use AmpedWeb\GlideInABox\Util\GlideUrl;

class PixelDensityTest extends TestCase
{
    /** @var GlideUrl $glideUrl */
    protected $glideUrl;

    public function setUp(): void
    {
        parent::setUp();

        $this->glideUrl = glide_url('foo.jpg');
    }

    public function testDprIsFluent()
    {
        $this->assertEquals($this->glideUrl, $this->glideUrl->dpr(1));
    }

    public function testDprSetsCorrectValue()
    {
        $this->glideUrl->dpr(4);
        $this->assertEquals(4, $this->glideUrl->getParams()['dpr']);
    }

    public function testDprFlattensMinimumValue()
    {
        $this->glideUrl->dpr(0);
        $this->assertEquals(1, $this->glideUrl->getParams()['dpr']);
    }

    public function testDprFlattensMaximumValue()
    {
        $this->glideUrl->dpr(9);
        $this->assertEquals(8, $this->glideUrl->getParams()['dpr']);
    }
}