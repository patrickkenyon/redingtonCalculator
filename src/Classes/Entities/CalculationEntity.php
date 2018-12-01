<?php

namespace Calculator\Entities;


class CalculationEntity
{
    private $probabilityA;
    private $probabilityB;

    /**
     * CalculationEntity constructor.
     * @param $probabilityA
     * @param $probabilityB
     */
    public function __construct($probabilityA, $probabilityB)
    {
        $this->probabilityA = $probabilityA;
        $this->probabilityB = $probabilityB;
    }


}