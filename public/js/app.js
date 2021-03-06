var app = angular.module('calculateApp', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

app.controller('calculateController', function($scope, $http) {


    // bind data to result input text and the first number input hidden text
    $scope.addNumber = function(num) {
        $scope.calculateResult = $scope.calculateResult ? $scope.calculateResult  + num : num;
        if ($scope.calculateDone) { // if the calculation has been done remove and add num to result text. clean all others field
            $scope.calculateResult = num;
            $scope.calculateNumber1 = num;
            $scope.calculateNumber2 = null;
            $scope.calculateSymbolText = null;
            $scope.calculateDone = null;
        } else if ($scope.calculateSymbolText == undefined) { // if the symbol (+, -, x) hasn't been click
            $scope.calculateNumber1 = $scope.calculateNumber1 ? $scope.calculateNumber1 + num : num;
        } else { // other wise add numbers to secondNumber field
            $scope.calculateNumber2 = $scope.calculateNumber2 ? $scope.calculateNumber2 + num : num;
        }
    };

    // bind data to result input text and change calculate Symbol to 1
    $scope.calculateSymbol = function(calSymbol) {
        if (!$scope.calculateSymbolText) {
            $scope.calculateResult = $scope.calculateResult ? $scope.calculateResult + ' ' + calSymbol + ' ' : "0 " + calSymbol;
            $scope.calculateSymbolText = calSymbol;
            console.log(calSymbol);
        }
    };

    // remove the letter from the end one by one number or Symbol.
    $scope.delNumber = function() {
        console.log('number');
        var calResult = $scope.calculateResult;
        if ($scope.calculateDone) { // if this calculation has been done clear all data.
            $scope.calculateResult = null;
            $scope.calculateNumber1 = null;
            $scope.calculateNumber2 = null;
            $scope.calculateSymbolText = null;
            $scope.calculateDone = null;
        } else if($scope.calculateNumber2) {
            $scope.calculateNumber2 = $scope.calculateNumber2.substring(0, $scope.calculateNumber2.length - 1);
            $scope.calculateResult = $scope.calculateResult.substring(0, $scope.calculateResult.length - 1);
        } else if($scope.calculateSymbolText) {
            $scope.calculateSymbolText = null;
            $scope.calculateResult = $scope.calculateResult.substring(0, $scope.calculateResult.length - 1);
        } else {
            $scope.calculateNumber1 = $scope.calculateNumber1.substring(0, $scope.calculateNumber1.length - 1);
            $scope.calculateResult = $scope.calculateResult.substring(0, $scope.calculateResult.length - 1);
        }
    };

    // caculate ajax
    $scope.calculate = function() {
        console.log($scope.calculateNumber1);
        $http.post('/api/calculateAll',
            {'firstNumber': $scope.calculateNumber1,
                'secondNumber': $scope.calculateNumber2,
                'calculateSymbol': $scope.calculateSymbolText})
            .success(function(response) {
                $scope.calculateResult = $scope.calculateResult + ' = ' + response.result;
                $scope.calculateDone = true;
            });
    };

});