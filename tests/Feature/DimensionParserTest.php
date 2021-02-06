<?php


namespace AmpedWeb\GlideInABox\Tests\Feature;


use AmpedWeb\GlideInABox\Exceptions\InvalidDimensionException;
use PHPUnit\Framework\TestCase;

class DimensionParserTest extends TestCase
{
    /** @var MockDimensionParser  */
    protected $mock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mock = new MockDimensionParser();
    }

    public function testDimensionIsRelativeIdentifiesRelativeDimensions()
    {
        $this->assertTrue($this->mock->dimensionIsRelative('34w'));
        $this->assertTrue($this->mock->dimensionIsRelative('34h'));
        $this->assertFalse($this->mock->dimensionIsRelative('34'));
        $this->assertFalse($this->mock->dimensionIsRelative('abcd'));
    }

    public function testValueIsNumberIdentifiesNumbers()
    {
        $this->assertTrue($this->mock->valueIsNumber(32));
        $this->assertTrue($this->mock->valueIsNumber(-34));
        $this->assertTrue($this->mock->valueIsNumber('55'));
        $this->assertFalse($this->mock->valueIsNumber('5h'));
        $this->assertFalse($this->mock->valueIsNumber('32w'));
        $this->assertFalse($this->mock->valueIsNumber('abcd'));
    }

    public function testParseDimensionParsesRelativeDimensionsCorrectly()
    {
        $this->assertEquals('25w', $this->mock->parseDimension('25w'));
        $this->assertEquals('100w', $this->mock->parseDimension('4452w'));
        $this->assertEquals('15h', $this->mock->parseDimension('15h'));
        $this->assertEquals('0h', $this->mock->parseDimension('0h'));
        $this->assertEquals('100h', $this->mock->parseDimension('1000h'));
    }

    public function testParseDimensionParsesAbsoluteDimensionsCorrectly()
    {
        $this->assertEquals(450, $this->mock->parseDimension('450'));
        $this->assertEquals(0, $this->mock->parseDimension(0));
        $this->assertEquals(999999999, $this->mock->parseDimension(-999999999));
    }

    public function testParseDimensionThrowsExceptionIfDimensionIsInvalid()
    {
        $this->expectException(InvalidDimensionException::class);
        $this->mock->parseDimension('this is not a dimension');
    }
}