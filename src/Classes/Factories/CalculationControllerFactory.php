<?php

namespace Calculator\Factories;


use Calculator\Controllers\CalculationController;
use Calculator\Models\CalculationModel;

class CalculationControllerFactory
{
    /**
     * @return CalculationController
     */
    public function __invoke()
    {
        $calculationModel = new CalculationModel();
        return new CalculationController($calculationModel);
    }
}