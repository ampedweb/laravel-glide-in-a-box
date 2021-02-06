<?php


namespace AmpedWeb\GlideInABox\Tests\Feature;


use AmpedWeb\GlideInABox\Traits\ColourParser;

class MockColourParser
{
    use ColourParser {
        isDefaultColour as _isDefaultColour;
        isThreeDigitRgb as _isThreeDigitRgb;
        isFourDigitArgb as _isFourDigitArgb;
        isSixDigitRgb as _isSixDigitRgb;
        isEightDigitArgb as _isEightDigitArgb;
        parseColour as _parseColour;
    }

    public function isDefaultColour(string $colour)
    {
        return $this->_isDefaultColour($colour);
    }

    public function isThreeDigitRgb(string $colour)
    {
        return $this->_isThreeDigitRgb($colour);
    }

    public function isFourDigitArgb(string $colour)
    {
        return $this->_isFourDigitArgb($colour);
    }

    public function isSixDigitRgb(string $colour)
    {
        return $this->_isSixDigitRgb($colour);
    }

    public function isEightDigitArgb(string $colour)
    {
        return $this->_isEightDigitArgb($colour);
    }

    public function parseColour(string $colour)
    {
        return $this->_parseColour($colour);
    }
}