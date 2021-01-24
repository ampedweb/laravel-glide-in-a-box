<?php


namespace AmpedWeb\GlideInABox\Tests\Feature;


use AmpedWeb\GlideInABox\Services\GlideSignatureValidationService;
use AmpedWeb\GlideInABox\Tests\TestCase;

class GlideSignatureValidationServiceTest extends TestCase
{
    public function testValidateProcessesACallbackOnError()
    {
        $service = $this->app->make(GlideSignatureValidationService::class);

        $expectedResponse = 'Foo';

        $callback = function () use ($expectedResponse) {
            return $expectedResponse;
        };

        $response = $service->validate('/this/will/fail', $callback);

        $this->assertEquals($expectedResponse, $response);
    }
}