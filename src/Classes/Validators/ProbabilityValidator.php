<?php

namespace Calculator\Validators;


class ProbabilityValidator
{
    /**
     * This checks whether a user defined string is numeric and between 0 and 1.
     *
     * @param $probability - is a user defined number between 0 and 1.
     * @return bool depending on whether the conditions are met by the input parameter.
     */
    public static function isValidProbability($probability): bool
    {
            if (is_numeric($probability) && $probability >= 0 && $probability <= 1) {
                return true;
            }
            return false;
        }
}