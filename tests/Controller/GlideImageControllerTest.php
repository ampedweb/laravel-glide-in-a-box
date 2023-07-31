<?php

namespace AmpedWeb\GlideInABox\Tests\Feature;

use AmpedWeb\GlideInABox\Controller\GlideImageController;
use AmpedWeb\GlideInABox\Tests\TestCase;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GlideImageControllerTest extends TestCase
{
    /**
     * @test
     */

    public function it_throws_a_403_when_signature_validation_fails()
    {
        // Arrange
        $controller = $this->app->make(GlideImageController::class);

        $this->expectException(HttpException::class);
        $this->expectExceptionMessage("It's not for you!");

        // Act
        $controller->image('foo');
    }

    /**
     * @test
     */

    public function it_accepts_a_callback_to_handle_failed_signature_verification()
    {
        // Arrange
        $controller = $this->app->make(GlideImageController::class);
        $controller->setSignatureFailedCallback(function () {return;});

        // Assert
        // If we "disable" the signature validation, then we should fall through to the next exception.
        $this->expectException(NotFoundHttpException::class);

        // Act
        $controller->image('foo');
    }

    /**
     * @test
     */

    public function it_throws_a_404_by_default_when_image_not_found()
    {
        // Arrange
        $controller = $this->app->make(GlideImageController::class);
        $controller->setSignatureFailedCallback(function () {return;});

        // Assert
        // We should get a 404 exception.
        $this->expectException(NotFoundHttpException::class);

        // Act
        $controller->image('foo');
    }

    /**
     * @test
     */

    public function it_accepts_a_callback_to_handle_file_not_found()
    {
        // Arrange
        $controller = $this->app->make(GlideImageController::class);
        $controller->setSignatureFailedCallback(function () {return;});
        $controller->setFileNotFoundCallback(function () {return 'hello foo!';});

        // Act
        $response = $controller->image('foo');

        // Assert
        $this->assertEquals('hello foo!', $response);
    }
}
