<?php

namespace AmpedWeb\GlideInABox\Tests\Unit;

use League\Flysystem\FilesystemOperator;
use Mockery;
use PHPUnit\Framework\TestCase;
use AmpedWeb\GlideInABox\Response\ResponseFactory;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ResponseFactoryTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function test_create_instance(): void
    {
        self::assertInstanceOf(ResponseFactory::class, new ResponseFactory());
    }

    public function test_create(): void
    {
        $cache = Mockery::mock(FilesystemOperator::class, function ($mock) {
            $mock->shouldReceive('mimeType')->andReturn('image/jpeg')->once();
            $mock->shouldReceive('fileSize')->andReturn(0)->once();
            $mock->shouldReceive('readStream');
        });

        $factory = new ResponseFactory();
        $response = $factory->create($cache, '');

        self::assertInstanceOf(StreamedResponse::class, $response);
        self::assertEquals('image/jpeg', $response->headers->get('Content-Type'));
        self::assertEquals('0', $response->headers->get('Content-Length'));
        self::assertStringContainsString(gmdate('D, d M Y H:i', strtotime('+1 years')), $response->headers->get('Expires'));
        self::assertEquals('max-age=31536000, public', $response->headers->get('Cache-Control'));
    }
}
