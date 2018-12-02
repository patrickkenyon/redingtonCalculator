<?php

namespace Tests\Controllers;


use Calculator\Controllers\CalculationController;
use Calculator\Models\CalculationModel;
use PHPUnit\Framework\TestCase;
use Slim\Http\Request;
use Slim\Http\Response;

class CalculationControllerTest Extends TestCase
{
    public $validProbabilityData = [
        "probabilityOne" => "0.7",
        "probabilityTwo" => "0.4",
        "calcType" => "combinedWith"
    ];

    public $successData = [
        'success' => true,
        'msg' => 'Successfully logged the calculation.',
        'result' => '0.28'
    ];

    public $failureData = [
        'success' => false,
        'msg' => 'Failed to log calculation.',
        'result' => ''
    ];

    public function testConstruct()
    {
        $mockCalculationModel = $this->createMock(CalculationModel::class);

        $case = new CalculationController($mockCalculationModel);
        $expected = CalculationController::class;
        $this->assertInstanceOf($expected, $case);
    }

    public function testInvoke_success()
    {
        $mockRequest = $this->createMock(Request::class);
        $mockResponse = $this->createMock(Response::class);

        $mockRequest->method('getParsedBody')->willReturn($this->validProbabilityData);

        $mockCalculationModel = $this->createMock(CalculationModel::class);
        $mockCalculationModel->method('logCalculation')->willReturn(true);

        $mockResponse
            ->method('withJson')
            ->with($this->successData, 200)
            ->willReturn(true);

        $calculationController = new CalculationController($mockCalculationModel);

        $result = $calculationController($mockRequest, $mockResponse);

        $this->assertTrue($result);
    }

    public function testInvoke_failure_writeToFileReturnFalse()
    {
        $mockRequest = $this->createMock(Request::class);
        $mockResponse = $this->createMock(Response::class);

        $mockRequest->method('getParsedBody')->willReturn($this->validProbabilityData);

        $mockCalculationModel = $this->createMock(CalculationModel::class);
        $mockCalculationModel->method('logCalculation')->willReturn(false);

        $mockResponse
            ->method('withJson')
            ->with($this->failureData, 406)
            ->willReturn(true);

        $calculationController = new CalculationController($mockCalculationModel);

        $result = $calculationController($mockRequest, $mockResponse);

        $this->assertTrue($result);
    }

    function testInvoke_malformed_emptyPostData()
    {
        $mockRequest = $this->createMock(Request::class);
        $mockResponse = $this->createMock(Response::class);

        $mockRequest->method('getParsedBody')->willReturn([]);

        $mockCalculationModel = $this->createMock(CalculationModel::class);
        $mockCalculationModel->method('logCalculation')->willReturn(false);

        $mockResponse
            ->method('withJson')
            ->with($this->failureData, 406)
            ->willReturn(true);

        $calculationController = new CalculationController($mockCalculationModel);

        $result = $calculationController($mockRequest, $mockResponse);

        $this->assertTrue($result);
    }

    // Can't seem to get this one to work.

//    function testInvokeFailure_writeToFileThrowException()
//    {
//        $mockRequest = $this->createMock(Request::class);
//        $mockResponse = $this->createMock(Response::class);
//
//        $mockRequest->method('getParsedBody')->willReturn($this->validProbabilityData);
//
//        $mockCalculationModel = $this->createMock(CalculationModel::class);
//        $this->expectException(\TypeError::class);
//        $mockCalculationModel->method('logCalculation');
//
//        $mockResponse
//            ->method('withJson')
//            ->with($this->failureData, 500)
//            ->willReturn(true);
//
//        $calculationController = new CalculationController($mockCalculationModel);
//
//        $result = $calculationController($mockRequest, $mockResponse);
//
//        $this->assertTrue($result);
//    }


}