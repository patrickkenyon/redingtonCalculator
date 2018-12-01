<?php

namespace Calculator\Models;


class CalculationModel
{
    private const CALCULATION_LOG = 'calculationLog.txt';

    public static function log(string $calculationMessage)
    {
        $calculationLog = fopen(self::CALCULATION_LOG, 'a+');
        fwrite($calculationLog, $calculationMessage . "\n");
        fclose($calculationLog);
    }
}