<?php


namespace AmpedWeb\GlideInABox\Tests\Feature;


use League\Glide\Signatures\Signature;
use League\Glide\Signatures\SignatureException;
use AmpedWeb\GlideInABox\Services\GlideSignatureValidationService;
use AmpedWeb\GlideInABox\Tests\TestCase;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GlideSignatureValidationServiceTest extends TestCase
{
    public function test_validate_processes_callback_if_signature_is_missing(): void
    {

        $service = new GlideSignatureValidationService(new Signature('12345'));

        $callback = function (SignatureException $e) {

            $this->assertEquals('Signature is missing.', $e->getMessage());

            return 'Signature has gone walkies!';
        };

        $response = $service->validate('/this/will/fail', ['w' => 200, 'h' => 200], callback: $callback);

        $this->assertEquals('Signature has gone walkies!', $response);
    }

    public function test_validate_processes_callback_if_signature_is_invalid(): void
    {

        $service = new GlideSignatureValidationService(new Signature('12345'));

        $callback = function (SignatureException $e) {

            $this->assertEquals('Signature is not valid.', $e->getMessage());

            return 'Signature is invalid';
        };

        $response = $service->validate('/this/will/fail', ['w' => 200, 'h' => 200, 's' => 'notvalidsig'], $callback);

        $this->assertEquals('Signature is invalid', $response);
    }


    public function test_403_response_is_thrown_when_signature_is_invalid_and_no_callback_is_provided()
    {

        $service = new GlideSignatureValidationService(new Signature('12345'));

        try {
            $service->validate('/this/will/fail', ['w' => 200, 'h' => 200, 's' => 'notvalidsig']);
        } catch (HttpException $e) {
            $this->assertEquals(403, $e->getStatusCode());
        }

    }


}