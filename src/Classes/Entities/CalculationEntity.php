<?php

namespace Calculator\Entities;


class CalculationEntity
{
    private $probabilityOne;
    private $probabilityTwo;
    private $result;
    private $calcType;
    private $date;


    /**
     * CalculationEntity constructor.
     * @param string $probabilityOne
     * @param string $probabilityTwo
     * @param string $result
     * @param string $calcType
     */
    public function __construct(string $probabilityOne, string $probabilityTwo, string $result, string $calcType)
    {
        $this->probabilityOne = $probabilityOne;
        $this->probabilityTwo = $probabilityTwo;
        $this->result = $result;
        $this->calcType = $calcType;
        $this->date = date("Y-m-d");
    }

    /**
     * @return mixed
     */
    public function getProbabilityOne(): string
    {
        return $this->probabilityOne;
    }

    /**
     * @return mixed
     */
    public function getProbabilityTwo(): string
    {
        return $this->probabilityTwo;
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