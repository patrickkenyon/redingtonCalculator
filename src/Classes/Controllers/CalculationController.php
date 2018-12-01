<?php

namespace Calculator\Controllers;


use Calculator\Models\CalculationModel;

class CalculationController
{
    private $calculationModel;

    /**
     * CalculationController constructor.
     * @param $calculationModel
     */
    public function __construct(CalculationModel $calculationModel)
    {
        $this->calculationModel = $calculationModel;
    }

    public function __invoke()
    {

    }


}