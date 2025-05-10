<?php

namespace AmpedWeb\GlideInABox\Controller;

use Closure;
use AmpedWeb\GlideInABox\Services\GlideSignatureValidationService;
use Exception;
use Illuminate\Routing\Controller;
use League\Flysystem\UnableToRetrieveMetadata;
use League\Glide\Filesystem\FileNotFoundException;
use League\Glide\Server;

class GlideImageController extends Controller
{

    protected Server $server;

    protected GlideSignatureValidationService $signatureValidation;

    protected ?Closure $signatureFailedCallback = null;

    protected ?Closure $fileNotFoundCallback = null;

    public function __construct(Server $server, GlideSignatureValidationService $signatureValidation)
    {
        $this->server = $server;
        $this->signatureValidation = $signatureValidation;
    }


    public function image(string $path)
    {

        if ($pathPrefix = config('glideinabox.base_url')) {
            $path = '/' . $pathPrefix . '/' . $path;
        }

        //If we don't pass validation this will "abort" or call our callback if we have one
        $this->signatureValidation->validate($path, request()->query(), $this->signatureFailedCallback);

        try {
            return $this->server->getImageResponse($path, request()->query());
        } catch (FileNotFoundException | UnableToRetrieveMetadata | Exception $e) {
            $callback = $this->fileNotFoundCallback;

            if (is_callable($callback)) {
                return $callback($e);
            }

            abort(404);
        }
    }


    public function setSignatureFailedCallback(?Closure $signatureFailedCallback = null): void
    {
        $this->signatureFailedCallback = $signatureFailedCallback;
    }


    public function setFileNotFoundCallback(?Closure $fileNotFoundCallback = null): void
    {
        $this->fileNotFoundCallback = $fileNotFoundCallback;
    }
}
