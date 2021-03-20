<?php


namespace AmpedWeb\GlideInABox\Tests\Feature;


use AmpedWeb\GlideInABox\Exceptions\InvalidBorderMethodException;
use AmpedWeb\GlideInABox\Interfaces\Border;
use AmpedWeb\GlideInABox\Tests\TestCase;
use AmpedWeb\GlideInABox\Util\GlideUrl;

class BorderTest extends TestCase
{
    /** @var GlideUrl */
    protected $glideUrl;

    public function setUp(): void
    {
        parent::setUp();
        $this->glideUrl = glide_url('cat.png');
    }

    public function testBorderIsFluent()
    {
        $this->assertEquals($this->glideUrl, $this->glideUrl->border(1, 'gray', Border::OVERLAY));
    }

    public function testBorderThrowsInvalidBorderMethodExceptionWhenPassedAnInvalidMethodParameter()
    {
        $this->expectException(InvalidBorderMethodException::class);

        $this->glideUrl->border(1, 'green', 'foo');
    }

    public function testBorderSetsTheCorrectMethodValue()
    {
        $this->glideUrl->border(1, '000000', Border::OVERLAY);
        $this->assertEquals(
            sprintf('%s,%s,%s', 1, '000000', Border::OVERLAY),
            $this->glideUrl->getParams()['border']
        );
    }

    public function testBorderSetsTheCorrectWidthValue()
    {
        $this->glideUrl->border(5, '000000');
        $this->assertEquals(
            sprintf('%s,%s,%s', 5, '000000', Border::OVERLAY),
            $this->glideUrl->getParams()['border']
        );

        $this->glideUrl->border('8w', 'fff');
        $this->assertEquals(
            sprintf('%s,%s,%s', '8w', 'FFF', Border::OVERLAY),
            $this->glideUrl->getParams()['border']
        );
    }

    public function testBorderSetsTheCorrectColourValue()
    {
        $this->glideUrl->border(5, 'fff');
        $this->assertEquals(
            sprintf('%s,%s,%s', 5, 'FFF', Border::OVERLAY),
            $this->glideUrl->getParams()['border']
        );

        $this->glideUrl->border(8, 'afff');
        $this->assertEquals(
            sprintf('%s,%s,%s', 8, 'AFFF', Border::OVERLAY),
            $this->glideUrl->getParams()['border']
        );

        $this->glideUrl->border(12, 'abcdef');
        $this->assertEquals(
            sprintf('%s,%s,%s', 12, 'ABCDEF', Border::OVERLAY),
            $this->glideUrl->getParams()['border']
        );

        $this->glideUrl->border(20, '12abcdef');
        $this->assertEquals(
            sprintf('%s,%s,%s', 20, '12ABCDEF', Border::OVERLAY),
            $this->glideUrl->getParams()['border']
        );
    }
}