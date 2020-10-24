<?php

namespace AmpedWeb\GlideInABox\Controller;
use AmpedWeb\GlideInABox\Services\GlideSignatureValidationService;
use Illuminate\Routing\Controller;
use League\Glide\Server;

class GlideImageController extends Controller
{
    /**
     * @var Server
     */
    protected $server;

    protected $signatureValidation;

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

    public function preset()
    {

    }

    public function custom($path)
    {
        //If we don't pass validation this will "abort"
        $this->signatureValidation->validate($path);

        return $this->server->getImageResponse($path, request()->all());
    }
}
