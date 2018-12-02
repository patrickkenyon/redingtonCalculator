<?php

namespace Tests\Controllers;


use Calculator\Controllers\HomePageController;
use PHPUnit\Framework\TestCase;
use Slim\Views\PhpRenderer;

class HomePageControllerTest Extends TestCase
{
    public function testConstruct()
    {
        $mockRenderer = $this->createMock(PhpRenderer::class);

        $case = new HomePageController($mockRenderer);
        $expected = HomePageController::class;
        $this->assertInstanceOf($expected, $case);
    }
}