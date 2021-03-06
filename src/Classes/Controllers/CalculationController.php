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

    /**
     * This receives a http request containing probability data. The data is sent to the validator for validation and, once
     * confirmed the initial probabilities, result, calculation type and date are logged to a text file.
     *
     * @param Request $request is a http request containing two probabilities between 0 and 1 as well as the calculation type.
     * @param Response $response is a http response
     * @return Response JSON contains (array) $data and (int) $statusCode, indicating success or failure information
     * as well as the result of the calculation.
     */
    public function __invoke(Request $request, Response $response)
    {
        $data = [
            'success' => false,
            'msg' => 'Failed to log calculation.',
            'result' => ''
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
            $successfulLog = $this->calculationModel->logCalculation($calculationEntity);
        } catch (\Error $e) {
            $statusCode = 500;
            return $response->withJson($data, $statusCode);
        }

        if ($successfulLog) {
            $data = [
                'success' => $successfulLog,
                'msg' => 'Successfully logged the calculation.',
                'result' => $result
            ];
            $statusCode = 200;
        }
        return $response->withJson($data, $statusCode);
    }

    /**
     * Takes two user defined probabilities and returns their sum.
     *
     * @param string $probOne is a user defined number between 0 and 1.
     * @param string $probTwo is a user defined number between 0 and 1.
     * @return string is the sum of the two initial probabilities.
     */
    public function combinedWith(string $probOne, string $probTwo): string
    {
        return $probOne * $probTwo;
    }

    /**
     * Takes two user defined probabilities and performs a calculation upon them as indicated below.
     *
     * @param string $probOne is a user defined number between 0 and 1.
     * @param string $probTwo is a user defined number between 0 and 1.
     * @return string is the total of $probOne and $probTwo minus the sum of probOne and probTwo.
     */
    public function either(string $probOne, string $probTwo): string
    {
        return $probOne + $probTwo - ($probOne * $probTwo);
    }
}

