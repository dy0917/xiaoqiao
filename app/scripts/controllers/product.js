'use strict';

/**
 * @ngdoc function
 * @name xtripApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the xtripApp
 */
angular.module('xiaoqiaoApp')
        .controller('ProductCtrl', function ($scope, $http, masonryService) {

            masonryService.masonryinit(50);
        });
angular.module('xiaoqiaoApp')
        .controller('calculatorCtrl', function ($scope, $http, servicecallback) {

            $scope.getResult = function (custom) {


                var path = apiPath + "/bankratio";

                servicecallback.getmethod(path).then(function (result) {
                    $scope.banks = result.data;
                    $scope.isResult = true;
                    $scope.$apply();
                });

            };
            $scope.formatincome = function (income) {
                var x = income.toString();
                var pattern = /(-?\d+)(\d{3})/;
                while (pattern.test(x))
                    x = x.replace(pattern, "$1,$2");
                return x;
            };
        });