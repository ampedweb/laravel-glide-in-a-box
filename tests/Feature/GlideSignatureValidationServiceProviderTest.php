<?php


namespace AmpedWeb\GlideInABox\Tests\Feature;


use AmpedWeb\GlideInABox\Providers\GlideSignatureValidationServiceProvider;
use AmpedWeb\GlideInABox\Services\GlideSignatureValidationService;
use AmpedWeb\GlideInABox\Tests\TestCase;

class GlideSignatureValidationServiceProviderTest extends TestCase
{
    public function testServiceProvidesSignatureValidationService()
    {
        $service = new GlideSignatureValidationServiceProvider($this->app);
        $this->assertContains(GlideSignatureValidationService::class, $service->provides());
    }
}