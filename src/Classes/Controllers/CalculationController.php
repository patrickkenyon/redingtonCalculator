<?php

namespace Calculator\Controllers;


use Calculator\Entities\CalculationEntity;
use Calculator\Models\CalculationModel;
use Calculator\Validators\ProbabilityValidator;
use Slim\Http\Request;
use Slim\Http\Response;

class CalculationController
{
    private $calculationModel;

    /**
     * CalculationController constructor.
     * @param $calculationModel
     */
    public function __construct(CalculationModel $calculationModel)
    {
        $this->calculationModel = $calculationModel;
    }

    public function __invoke(Request $request, Response $response): Response
    {
        $data = [
            'success' => false,
            'msg' => 'Failed to log calculation.',
            'data' => []
        ];
        $statusCode = 406;

        $probabilities = $request->getParsedBody();
        $calcType = $probabilities['calcType'];
        unset($probabilities['calcType']);

        $validProbabilityOne = ProbabilityValidator::isValidProbability($probabilities['probabilityOne']);
        $validProbabilityTwo = ProbabilityValidator::isValidProbability($probabilities['probabilityTwo']);

        if (!$validProbabilityOne || !$validProbabilityTwo) {
            return $response->withJson($data, $statusCode);
        }

        if ($calcType == 'combinedWith') {
            $result = $this->combinedWith(floatval($probabilities['probabilityOne']), $probabilities['probabilityTwo']);
        } elseif ($calcType == 'either') {
            $result = $this->either($probabilities['probabilityOne'], $probabilities['probabilityTwo']);
        } else {
            return $response->withJson($data, $statusCode);
        }

        $calculationEntity = new CalculationEntity(
            $probabilities['probabilityOne'],
            $probabilities['probabilityTwo'],
            $result,
            $calcType
        );

        try {
            $successfulLog = $this->calculationModel->log($calculationEntity);
        } catch (\Error $e) {
            $statusCode = 500;
            return $response->withJson($data, $statusCode);
        }

        if ($successfulLog) {
            $data = [
                'success' => $successfulLog,
                'msg' => 'Successfully logged the calculation.',
                'data' => []
            ];
            $statusCode = 200;
        }
        return $response->withJson($data, $statusCode);
    }

    public function combinedWith(string $probA, string $probB): string
    {
        return $probA * $probB;
    }

    public function either(string $probA, string $probB): string
    {
        return $probA + $probB - ($probA * $probB);
    }
}

