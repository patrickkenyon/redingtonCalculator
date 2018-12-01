<?php

namespace Calculator\Models;


use Calculator\Entities\CalculationEntity;

class CalculationModel
{
    private const CALCULATION_LOG = 'calculationLog.txt';

    public static function log(CalculationEntity $calculationEntity)
    {
        $calculationLog = fopen(self::CALCULATION_LOG, 'a+');
        $success = fwrite($calculationLog,
            'Probability A: ' . $calculationEntity->getProbabilityA() .
            ', Probability B: ' . $calculationEntity->getProbabilityB() .
            ', Result: ' . $calculationEntity->getResult() .
            ', Calculation type: ' . $calculationEntity->getCalcType() .
            ', Date: ' . $calculationEntity->getDate() .
            "\n");
        fclose($calculationLog);
        return !$success ? false : true;
    }
}