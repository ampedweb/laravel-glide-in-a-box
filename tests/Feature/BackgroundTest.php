<?php


namespace AmpedWeb\GlideInABox\Tests\Feature;


use AmpedWeb\GlideInABox\Tests\TestCase;
use AmpedWeb\GlideInABox\Util\GlideUrl;

class BackgroundTest extends TestCase
{
    /** @var GlideUrl */
    protected $glideUrl;

    public function setUp(): void
    {
        parent::setUp();
        $this->glideUrl = glide_url('cat.png');
    }

    public function testBgIsFluent()
    {
        $this->assertSame($this->glideUrl, $this->glideUrl->bg('abc'));
    }

    public function testBgSetsCorrectValue()
    {
        $this->glideUrl->bg('def');
        $this->assertEquals('DEF', $this->glideUrl->getParams()['bg']);
    }

    public function testBackgroundSetsCorrectValue()
    {
        $this->glideUrl->background('0123CDEF');
        $this->assertEquals('0123CDEF', $this->glideUrl->getParams()['bg']);
    }
}