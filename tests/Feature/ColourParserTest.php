<?php


namespace AmpedWeb\GlideInABox\Tests\Feature;


use AmpedWeb\GlideInABox\Exceptions\InvalidColourException;
use PHPUnit\Framework\TestCase;

class ColourParserTest extends TestCase
{
    /** @var MockColourParser */
    protected $mock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mock = new MockColourParser();
    }

    public function testIsDefaultColourRecognisesAllDefaultColours()
    {
        $colours = [
            'aliceblue',
            'antiquewhite',
            'aqua',
            'aquamarine',
            'azure',
            'beige',
            'bisque',
            'black',
            'blanchedalmond',
            'blue',
            'blueviolet',
            'brown',
            'burlywood',
            'cadetblue',
            'chartreuse',
            'chocolate',
            'coral',
            'cornflowerblue',
            'cornsilk',
            'crimson',
            'cyan',
            'darkblue',
            'darkcyan',
            'darkgoldenrod',
            'darkgray',
            'darkgreen',
            'darkkhaki',
            'darkmagenta',
            'darkolivegreen',
            'darkorange',
            'darkorchid',
            'darkred',
            'darksalmon',
            'darkseagreen',
            'darkslateblue',
            'darkslategray',
            'darkturquoise',
            'darkviolet',
            'deeppink',
            'deepskyblue',
            'dimgray',
            'dodgerblue',
            'firebrick',
            'floralwhite',
            'forestgreen',
            'fuchsia',
            'gainsboro',
            'ghostwhite',
            'gold',
            'goldenrod',
            'gray',
            'green',
            'greenyellow',
            'honeydew',
            'hotpink',
            'indianred',
            'indigo',
            'ivory',
            'khaki',
            'lavender',
            'lavenderblush',
            'lawngreen',
            'lemonchiffon',
            'lightblue',
            'lightcoral',
            'lightcyan',
            'lightgoldenrodyellow',
            'lightgray',
            'lightgreen',
            'lightpink',
            'lightsalmon',
            'lightseagreen',
            'lightskyblue',
            'lightslategray',
            'lightsteelblue',
            'lightyellow',
            'lime',
            'limegreen',
            'linen',
            'magenta',
            'maroon',
            'mediumaquamarine',
            'mediumblue',
            'mediumorchid',
            'mediumpurple',
            'mediumseagreen',
            'mediumslateblue',
            'mediumspringgreen',
            'mediumturquoise',
            'mediumvioletred',
            'midnightblue',
            'mintcream',
            'mistyrose',
            'moccasin',
            'navajowhite',
            'navy',
            'oldlace',
            'olive',
            'olivedrab',
            'orange',
            'orangered',
            'orchid',
            'palegoldenrod',
            'palegreen',
            'paleturquoise',
            'palevioletred',
            'papayawhip',
            'peachpuff',
            'peru',
            'pink',
            'plum',
            'powderblue',
            'purple',
            'rebeccapurple',
            'red',
            'rosybrown',
            'royalblue',
            'saddlebrown',
            'salmon',
            'sandybrown',
            'seagreen',
            'seashell',
            'sienna',
            'silver',
            'skyblue',
            'slateblue',
            'slategray',
            'snow',
            'springgreen',
            'steelblue',
            'tan',
            'teal',
            'thistle',
            'tomato',
            'turquoise',
            'violet',
            'wheat',
            'white',
            'whitesmoke',
            'yellow',
            'yellowgreen',
        ];

        foreach ($colours as $colour) {
            $this->assertTrue($this->mock->isDefaultColour($colour));
        }

        $this->assertFalse($this->mock->isDefaultColour('foo'));
    }

    public function testIsThreeDigitRgbWorks()
    {
        $this->assertTrue($this->mock->isThreeDigitRgb('ABC'));
        $this->assertTrue($this->mock->isThreeDigitRgb('AB4'));
        $this->assertFalse($this->mock->isThreeDigitRgb('XYZ'));
        $this->assertFalse($this->mock->isThreeDigitRgb('AABBCC'));
    }

    public function testIsFourDigitArgbWorks()
    {
        $this->assertTrue($this->mock->isFourDigitArgb('ABCD'));
        $this->assertTrue($this->mock->isFourDigitArgb('012F'));
        $this->assertTrue($this->mock->isFourDigitArgb('1234'));
        $this->assertFalse($this->mock->isFourDigitArgb('abc'));
        $this->assertFalse($this->mock->isFourDigitArgb('wxyzabcd'));
        $this->assertFalse($this->mock->isFourDigitArgb('wxyz'));
    }

    public function testIsSixDigitRgbWorks()
    {
        $this->assertTrue($this->mock->isSixDigitRgb('AABBCF'));
        $this->assertTrue($this->mock->isSixDigitRgb('023459'));
        $this->assertFalse($this->mock->isSixDigitRgb('213'));
        $this->assertFalse($this->mock->isSixDigitRgb('1234567'));
        $this->assertFalse($this->mock->isSixDigitRgb('xyzabc'));
    }

    public function testIsEightDigitArgbWorks()
    {
        $this->assertTrue($this->mock->isEightDigitArgb('FFFFFFAA'));
        $this->assertTrue($this->mock->isEightDigitArgb('0123CDEF'));
        $this->assertFalse($this->mock->isEightDigitArgb('0123CDEF1'));
        $this->assertFalse($this->mock->isEightDigitArgb('ABC'));
        $this->assertFalse($this->mock->isEightDigitArgb('XYZABCDE'));
    }

    public function testParseColourThrowsExceptionWithInvalidColourParameter()
    {
        $this->expectException(InvalidColourException::class);

        $this->mock->parseColour('foo');
    }

    public function testParseColourWorks()
    {
        $this->assertEquals('darkgray', $this->mock->parseColour('darkgraY'));
        $this->assertEquals('ABC', $this->mock->parseColour('abc'));
        $this->assertEquals('ABCD', $this->mock->parseColour('abcd'));
        $this->assertEquals('FFEEFF', $this->mock->parseColour('ffeeff'));
        $this->assertEquals('0123CDEF', $this->mock->parseColour('0123CDEf'));
    }
}