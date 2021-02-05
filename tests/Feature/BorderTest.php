<?php


namespace AmpedWeb\GlideInABox\Tests\Feature;


use AmpedWeb\GlideInABox\Exceptions\InvalidBorderMethodException;
use AmpedWeb\GlideInABox\Tests\TestCase;
use AmpedWeb\GlideInABox\Traits\Border;
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
        $this->assertEquals($this->glideUrl, $this->glideUrl->border(1, 2, Border::$BORDERMETHOD_OVERLAY));
    }

    public function testBorderThrowsInvalidBorderMethodExceptionWhenPassedAnInvalidMethodParameter()
    {
        $this->expectException(InvalidBorderMethodException::class);

        $this->glideUrl->border(1, 2, 'foo');
    }

    public function testBorderSetsTheCorrectMethodValue()
    {
        $this->glideUrl->border(1, 2, Border::$BORDERMETHOD_OVERLAY);
        $this->assertEquals(sprintf('%s,%s,%s', 1, 2, Border::$BORDERMETHOD_OVERLAY),
                            $this->glideUrl->getParams()['border']);
    }
}