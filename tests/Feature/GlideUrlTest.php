<?php


namespace AmpedWeb\GlideInABox\Tests\Feature;


use AmpedWeb\GlideInABox\Tests\TestCase;
use AmpedWeb\GlideInABox\Util\GlideUrl;

class GlideUrlTest extends TestCase
{
    public function testParsedPathRemovesFirstInstanceOfStorage()
    {
        $glideUrl = new GlideUrl();
        $glideUrl->setPath('/storage/foo/bar');
        $this->assertEquals('foo/bar', $glideUrl->getParsedPath());
    }

    public function testBuiltParamsArrayIsInitialised()
    {
        $this->assertIsArray((new GlideUrl())->getParams());
    }

    public function testHelperHandlesNullInputGracefully()
    {
        $this->assertEquals('', glide_url());
    }
}