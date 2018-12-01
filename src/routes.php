<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes


//front end
$app->get('/', 'HomePageController');


//back end
$app->post('/newCalculation', 'CalculationController');