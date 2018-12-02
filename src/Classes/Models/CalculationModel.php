<?php

namespace Calculator\Models;


use Calculator\Entities\CalculationEntity;

class CalculationModel
{
    public const CALCULATION_LOG = 'calculationLog.txt';

    /**
     * LogCalculation attempts to write pertinent information to the calculationLog.txt file. One line is used per entry
     * and information includes: probability One and Two (both are numbers between 0 and 1), the result of the sum,
     * the calculation type and date that the calculation was performed.
     *
     * @param CalculationEntity $calculationEntity is an object which contains information pertaining to the calculation
     * which has been performed. It contains: two probabilities, the result, calculation type and date that the calculation
     * was performed.
     * @return bool depending on whether the calculation was successfully logged to calculationLog.txt.
     */
    public function logCalculation(CalculationEntity $calculationEntity): bool
    {
        $calculationLog = fopen(self::CALCULATION_LOG, 'a+');
        $success = fwrite($calculationLog,
            'Probability A: ' . $calculationEntity->getProbabilityOne() .
            ', Probability B: ' . $calculationEntity->getProbabilityTwo() .
            ', Result: ' . $calculationEntity->getResult() .
            ', Calculation type: ' . $calculationEntity->getCalcType() .
            ', Date: ' . $calculationEntity->getDate() .
            "\n");
        fclose($calculationLog);
        return !$success ? false : true;
    }
}