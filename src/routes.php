<?php

//Routes

//front end
$app->get('/', 'HomePageController');


//back end
$app->post('/newCalculation', 'CalculationController');