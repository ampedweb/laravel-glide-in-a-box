<?php


namespace AmpedWeb\GlideInABox\Tests\Feature;


use AmpedWeb\GlideInABox\Providers\SignatureServiceProvider;
use AmpedWeb\GlideInABox\Tests\TestCase;
use League\Glide\Signatures\Signature;

class SignatureServiceProviderTest extends TestCase
{
    public function testServiceProvidesSignatureService()
    {
        $provider = new SignatureServiceProvider($this->app);
        $this->assertContains(Signature::class, $provider->provides());
    }
}