<!doctype html>
<html lang="en">
<head>
    <title>Calculator</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="js/calculator.js" defer></script>
</head>
<body>
<h1>Calculator</h1>
<div id="message"></div>
<form id="calculatorForm">
    <div class="formField">
        <label for="probabilityOne" class="calculatorLabels">Probability One</label>
        <input type="number" id="probabilityOne" class="probabilities" name="probabilityOne" data-required="true" required>
    </div>
    <div class="formField">
        <label for="probabilityTwo" class="calculatorLabels">Probability Two</label>
        <input type="number" id="probabilityTwo" class="probabilities" name="probabilityTwo" data-required="true" required>
    </div>
    <div class="buttonWrapper">
        <input type="submit" id="calculatorSubmit">
    </div>
</form>
<p class="statusMessage"></p>
</body>
</html>