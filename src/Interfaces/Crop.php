<?php


namespace AmpedWeb\GlideInABox\Interfaces;


interface Crop
{
    /**
     * @var string Select "top left" crop position
     * @see HasCrop::cropToPosition()
     */
    const TOP_LEFT = 'crop-top-left';

    /**
     * @var string Select "top centre" crop position
     * @see HasCrop::cropToPosition()
     */
    const TOP = 'crop-top';

    /**
     * @var string Select "top right" crop position
     * @see HasCrop::cropToPosition()
     */
    const TOP_RIGHT = 'crop-top-right';

    /**
     * @var string Select "centre left" crop position
     * @see HasCrop::cropToPosition()
     */
    const LEFT = 'crop-left';

    /**
     * @var string Select "centre" crop position
     * @see HasCrop::cropToPosition()
     */
    const CENTER = 'crop-center';

    /**
     * @var string Select "centre right" crop position
     * @see HasCrop::cropToPosition()
     */
    const RIGHT = 'crop-right';

    /**
     * @var string Select "bottom left" crop position
     * @see HasCrop::cropToPosition()
     */
    const BOTTOM_LEFT = 'crop-bottom-left';

    /**
     * @var string Select "bottom centre" crop position
     * @see HasCrop::cropToPosition()
     */
    const BOTTOM = 'crop-bottom';

    /**
     * @var string Select "bottom right" crop position
     * @see HasCrop::cropToPosition()
     */
    const BOTTOM_RIGHT = 'crop-bottom-right';
}