<?php

namespace AmpedWeb\GlideInABox\Controller;
use AmpedWeb\GlideInABox\Services\GlideSignatureValidationService;
use Exception;
use Illuminate\Routing\Controller;
use League\Flysystem\UnableToRetrieveMetadata;
use League\Glide\Filesystem\FileNotFoundException;
use League\Glide\Server;

class GlideImageController extends Controller
{
    /**
     * @var Server
     */
    protected $server;

    protected $signatureValidation;

    protected $signatureFailedCallback;

    protected $fileNotFoundCallback;

    /**
     * ImageController constructor.
     *
     * @param Server                          $server
     * @param GlideSignatureValidationService $signatureValidation
     */
    public function __construct(Server $server, GlideSignatureValidationService $signatureValidation)
    {
        $this->server = $server;
        $this->signatureValidation = $signatureValidation;
    }


    public function image($path)
    {
        //If we don't pass validation this will "abort" or call our callback if we have one
        $this->signatureValidation->validate($path, $this->signatureFailedCallback);

        try {
            return $this->server->getImageResponse($path, request()->all());
        } catch (FileNotFoundException|UnableToRetrieveMetadata|Exception $exception) {
            $callback = $this->fileNotFoundCallback;

            if (is_callable($callback)) {
                return $callback();
            }

            abort(404);
        }
    }

    /**
     * @param mixed $signatureFailedCallback
     */
    public function setSignatureFailedCallback(callable $signatureFailedCallback = null): void
    {
        $this->signatureFailedCallback = $signatureFailedCallback;
    }

    /**
     * @param mixed $fileNotFoundCallback
     */
    public function setFileNotFoundCallback(callable $fileNotFoundCallback = null): void
    {
        $this->fileNotFoundCallback = $fileNotFoundCallback;
    }
}
