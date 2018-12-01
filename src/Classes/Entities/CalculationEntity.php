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
    public function __construct($probabilityA, $probabilityB, $result, $calcType)
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
    public function getProbabilityA()
    {
        return $this->probabilityA;
    }

    /**
     * @return mixed
     */
    public function getProbabilityB()
    {
        return $this->probabilityB;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return mixed
     */
    public function getCalcType()
    {
        return $this->calcType;
    }

    /**
     * @return false|string
     */
    public function getDate()
    {
        return $this->date;
    }


}