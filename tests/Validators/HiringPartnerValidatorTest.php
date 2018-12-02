<?php

namespace Tests\Validators;


use Calculator\Validators\ProbabilityValidator;
use PHPUnit\Framework\TestCase;

class HiringPartnerValidatorTest Extends TestCase
{
    public function testIsValidProbability_success()
    {
        $this->assertTrue(ProbabilityValidator::isValidProbability('0.7'));
    }

    public function testIsValidProbability_failureNumTooLarge()
    {
        $this->assertFalse(ProbabilityValidator::isValidProbability('1.2'));
    }

    public function testIsValidProbability_failureNumTooSmall()
    {
        $this->assertFalse(ProbabilityValidator::isValidProbability('-1.2'));
    }

    public function testIsValidProbability_failureString()
    {
        $this->assertFalse(ProbabilityValidator::isValidProbability('hello'));
    }

    public function testIsValidProbability_malformed()
    {
        $this->assertFalse(ProbabilityValidator::isValidProbability([]));
    }
}