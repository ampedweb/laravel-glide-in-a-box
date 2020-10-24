<?php


namespace AmpedWeb\GlideInABox\Services;


use AmpedWeb\GlideInABox\Interfaces\SignatureValidationServiceInterface;
use Closure;
use League\Glide\Signatures\Signature;
use League\Glide\Signatures\SignatureException;

class GlideSignatureValidationService implements SignatureValidationServiceInterface
{


    protected $baseImgDir;

    /**
     * @var Signature
     */
    protected $signature;

    /**
     * GlideImageRequestValidationService constructor.
     *
     * @param Signature   $signature
     * @param string|null $baseImgDir
     */
    public function __construct(Signature $signature, string $baseImgDir = null)
    {
        $this->signature = $signature;
        $this->baseImgDir = $baseImgDir;
    }


    /**
     * @param               $path
     * @param Closure|null $callback
     *
     * @return mixed
     */
    public function validate($path, Closure $callback = null)
    {
        try {
            // Validate HTTP signature
            $this->signature->validateRequest('/' . $this->baseImgDir . '/' . $path, request()->all());

        } catch (SignatureException $e) {

            if($callback instanceof Closure) {
                return $callback();
            }

            abort(403, "It's not for you!");
        }

        return null;
    }

}
