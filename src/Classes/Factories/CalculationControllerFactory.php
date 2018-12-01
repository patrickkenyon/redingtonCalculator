<?php

namespace Calculator\Factories;


use Calculator\Controllers\CalculationController;
use Calculator\Models\CalculationModel;

class CalculationControllerFactory
{
    public function __invoke()
    {
        $calculationModel = new CalculationModel();
        return new CalculationController($calculationModel);
    }
}