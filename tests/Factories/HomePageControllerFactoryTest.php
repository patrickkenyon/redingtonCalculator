<?php

namespace Tests\Factories;


use Calculator\Controllers\HomePageController;
use Calculator\Factories\HomePageControllerFactory;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Slim\Views\PhpRenderer;

class HomePageControllerFactoryTest Extends TestCase
{
    public function testInvoke()
    {
        $mockContainer = $this->createMock(ContainerInterface::class);
        $mockRenderer = $this->createMock(PhpRenderer::class);

        $mockContainer->method('get')->willReturn($mockRenderer);

        $factory = new HomePageControllerFactory();
        $case = $factory($mockContainer);
        $expected = HomePageController::class;
        $this->assertInstanceOf($expected, $case);
    }
}
