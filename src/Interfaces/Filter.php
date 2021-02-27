<?php


namespace AmpedWeb\GlideInABox\Interfaces;


interface Filter
{
    /** @var string Apply a "greyscale" filter to the image */
    const GREYSCALE = 'greyscale';

    /** @var string Apply a "sepia" filter to the image */
    const SEPIA = 'sepia';
}