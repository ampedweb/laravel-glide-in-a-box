<?php


namespace AmpedWeb\GlideInABox\Services;


use Illuminate\Http\Request;
use League\Glide\Signatures\SignatureInterface;
use AmpedWeb\GlideInABox\Interfaces\SignatureValidationServiceInterface;
use Closure;
use League\Glide\Signatures\SignatureException;

class GlideSignatureValidationService implements SignatureValidationServiceInterface
{

    protected SignatureInterface $signature;

    protected Request $request;

    public function __construct(SignatureInterface $signature)
    {
        $this->signature = $signature;
    }


    public function validate(string $path, array $params = [], ?Closure $callback = null): Closure | bool
    {

        try {
            // Validate HTTP signature
            $this->signature->validateRequest($path, $params);

        } catch (SignatureException $e) {

            if ($callback instanceof Closure) {
                return $callback($e);
            }

            abort(403);
        }

        return true;

    }

}
