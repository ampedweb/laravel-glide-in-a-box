<?php


namespace AmpedWeb\GlideInABox\Traits;

use AmpedWeb\GlideInABox\Exceptions\InvalidColourException;
use function preg_match;
use function strtoupper;

/**
 * This trait provide colour parsing functionality.
 *
 * Glide supports a variety of color formats. In addition to the 140 color names supported by all modern browsers
 * (listed below), Glide accepts hexadecimal RGB and RBG alpha formats.
 *
 * @package AmpedWeb\GlideInABox\Traits
 * @link    https://glide.thephpleague.com/1.0/api/colors/
 */
trait ColourParser
{
    /** @var string[] A list of default colour names */
    protected $colours = [
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

    /**
     * Attempt to identify the colour value.
     *
     * This function identifies the following colour types:
     *
     * - default colours
     * - 3 digit RGB hex
     * - 4 digit ARGB hex
     * - 6 digit RRGGBB hex
     * - 8 digit AARRGGBB hex
     *
     * An InvalidColourException is thrown if the $colour parameter is not one of these types.
     *
     * @param string $colour
     *
     * @return string
     * @throws InvalidColourException
     */
    protected function parseColour(string $colour)
    {
        if ($this->isDefaultColour($colour)) {
            return strtolower($colour);
        }

        if ($this->isThreeDigitRgb($colour) ||
            $this->isFourDigitArgb($colour) ||
            $this->isSixDigitRgb($colour) ||
            $this->isEightDigitArgb($colour)
        ) {
            return strtoupper($colour);
        }

        throw new InvalidColourException();
    }

    /**
     * Is the colour one of the defined default colours?
     *
     * @param string $colour
     *
     * @return bool
     */
    protected function isDefaultColour(string $colour)
    {
        return in_array(strtolower($colour), $this->colours);
    }

    /**
     * Is the colour a three digit RGB hex?
     *
     * @param string $colour
     *
     * @return bool
     */
    protected function isThreeDigitRgb(string $colour)
    {
        $rgbRegex = '/^[0-9A-F]{3}$/';

        return preg_match($rgbRegex, strtoupper($colour)) > 0;
    }

    /**
     * Is the colour a four digit ARGB hex?
     *
     * @param string $colour
     *
     * @return bool
     */
    protected function isFourDigitArgb(string $colour)
    {
        $argbRegex = '/^[0-9A-F]{4}$/';

        return preg_match($argbRegex, strtoupper($colour)) > 0;
    }

    /**
     * Is the colour a six digit RRGGBB hex?
     *
     * @param string $colour
     *
     * @return bool
     */
    protected function isSixDigitRgb(string $colour)
    {
        $rgbRegex = '/^[0-9A-F]{6}$/';

        return preg_match($rgbRegex, strtoupper($colour)) > 0;
    }

    /**
     * Is the colour an eight digit AARRGGBB hex?
     *
     * @param string $colour
     *
     * @return bool
     */
    protected function isEightDigitArgb(string $colour)
    {
        $argbRegex = '/^[0-9A-F]{8}$/';

        return preg_match($argbRegex, strtoupper($colour)) > 0;
    }
}