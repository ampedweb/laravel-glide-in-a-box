<?php


namespace AmpedWeb\GlideInABox\Interfaces;

use Closure;

interface SignatureValidationServiceInterface
{
    public function validate(string $path, array $params, ?Closure $callback = null): Closure | bool;
}
