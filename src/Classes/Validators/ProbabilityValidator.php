<?php

namespace Calculator\Validators;


class ProbabilityValidator
{
    public static function isValidProbability(string $probability): bool
    {
            if (is_numeric($probability) && $probability >= 0 && $probability <= 1) {
                return true;
            }
            return false;
        }
}