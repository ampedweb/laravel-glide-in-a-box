<?php

namespace AmpedWeb\GlideInABox\Signatures;

use League\Glide\Signatures\SignatureInterface;

/**
 * We use this for when signature validation is disabled.
 */
class AlwaysValidSignature implements SignatureInterface
{

    public function addSignature(string $path, array $params): array
    {
        //Don't bother adding the signature param!
        return $params;
    }

    public function validateRequest(string $path, array $params): void
    {
        //Just don't throw anything for a valid request!
    }
}