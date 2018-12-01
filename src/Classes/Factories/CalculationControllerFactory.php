<?php

namespace Calculator\Factories;


use Calculator\Controllers\CalculationController;
use Psr\Container\ContainerInterface;

class CalculationControllerFactory
{
    public function __invoke(ContainerInterface $container): CalculationController
    {
        $calculationModel = $container->get('CalculationModel');
        return new CalculationController($calculationModel);
    }
}