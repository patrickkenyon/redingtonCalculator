<?php

namespace Calculator\Entities;


class CalculationEntity
{
    private $probabilityA;
    private $probabilityB;
    private $result;
    private $calcType;
    private $date;

    /**
     * CalculationEntity constructor.
     * @param $probabilityA
     * @param $probabilityB
     * @param $result
     * @param $calcType
     */
    public function __construct(string $probabilityA, string $probabilityB, string $result, string $calcType)
    {
        $this->probabilityA = $probabilityA;
        $this->probabilityB = $probabilityB;
        $this->result = $result;
        $this->calcType = $calcType;
        $this->date = date("Y-m-d");
    }

    /**
     * @return mixed
     */
    public function getProbabilityA(): string
    {
        return $this->probabilityA;
    }

    /**
     * @return mixed
     */
    public function getProbabilityB(): string
    {
        return $this->probabilityB;
    }

    /**
     * @return mixed
     */
    public function getResult(): string
    {
        return $this->result;
    }

    /**
     * @return mixed
     */
    public function getCalcType():string
    {
        return $this->calcType;
    }

    /**
     * @return false|string
     */
    public function getDate(): string
    {
        return $this->date;
    }


}