<?php

namespace Calculator\Controllers;


use Calculator\CalculationValidator;
use Calculator\Entities\CalculationEntity;
use Calculator\Models\CalculationModel;
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

    public function __invoke(Request $request, Response $response)
    {
        $data = [
            'success' => false,
            'msg' => 'Calculation not logged.',
            'data' => []
        ];
        $statusCode = 406;

        $probabilities = $request->getParsedBody();

        $validProbabilities = CalculationValidator::isValidProbability($data);

        if (!$validProbabilities) {
            return $response->withJson($data, $statusCode);
        }

        $result = $this->combinedWith($probabilities['probabilityOne'], $probabilities['probabilityTwo']);

        $calculationEntity = new CalculationEntity(
            $probabilities['probabilityOne'],
            $probabilities['probabilityTwo'],
            $result,
            'combinedWith'
        );

        try {
            $successfulLog = $this->calculationModel->log($calculationEntity);
        } catch (\Exception $e) {
            $statusCode = 500;
            var_dump('exception');
            return $response->withJson($data, $statusCode);
        } catch (\Error $e) {
            $statusCode = 500;
            var_dump('error');
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

    public function combinedWith($probA, $probB)
    {
        return $probA * $probB;
    }

    public function either($probA, $probB)
    {
        return $probA + $probB - ($probA * $probB);
    }
}

