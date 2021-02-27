<?php


namespace AmpedWeb\GlideInABox\Interfaces;


interface Border
{
    /** @var string Place border on top of image (default). */
    const OVERLAY = 'overlay';

    /** @var string Shrink image within border (canvas does not change). */
    const SHRINK = 'shrink';

    /** @var string Expands canvas to accommodate border. */
    const EXPAND = 'expand';
}