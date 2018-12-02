<?php

namespace Tests\Models;


use Calculator\Entities\CalculationEntity;
use Calculator\Models\CalculationModel;
use PHPUnit\Framework\TestCase;

class CalculationModelTest Extends TestCase
{
    public $probabilityCalculatorData = [
        "probabilityOne" => "0.7",
        "probabilityTwo" => "0.4",
        "result" => "0.33",
        "calculation" => "combinedWith",
        "date" => "2018/12/02"
    ];

    public function testLogCalculation_success()
    {
        $mockCalculationEntity = $this->createMock(CalculationEntity::class);

        $mockCalculationEntity->method('getProbabilityOne')->willReturn($this->probabilityCalculatorData['probabilityOne']);
        $mockCalculationEntity->method('getProbabilityTwo')->willReturn($this->probabilityCalculatorData['probabilityTwo']);
        $mockCalculationEntity->method('getResult')->willReturn($this->probabilityCalculatorData['result']);
        $mockCalculationEntity->method('getCalcType')->willReturn($this->probabilityCalculatorData['calculation']);
        $mockCalculationEntity->method('getDate')->willReturn($this->probabilityCalculatorData['date']);

    }

    public function testLogCalculation_success_fileIsWritable()
    {
        $this->assertFileIsWritable(CalculationModel::CALCULATION_LOG);
    }
}
