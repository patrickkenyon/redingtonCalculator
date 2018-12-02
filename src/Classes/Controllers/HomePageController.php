<?php

namespace Calculator\Controllers;


use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\PhpRenderer;

class HomePageController
{
    private $renderer;

    /**
     * HomePageController constructor.
     * @param PhpRenderer $renderer
     */
    function __construct(PhpRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @param Request $request is a http request initiated when a user navigates to the calculator home page.
     * @param Response $response
     * @param $args
     * @return \Psr\Http\Message\ResponseInterface contains the (obj) $response, template to be used calculatorHome.phtml
     * and $args which does not currently contain any data.
     */
    function __invoke(Request $request, Response $response, $args)
    {
        return $this->renderer->render($response, 'calculatorHome.phtml', $args);
    }

}
