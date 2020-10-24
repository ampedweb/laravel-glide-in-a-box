<?php


namespace AmpedWeb\GlideInABox\Interfaces;

use Closure;

interface SignatureValidationServiceInterface
{
    public function validate($path, Closure $callback = null);
}
