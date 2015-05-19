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
        .controller('calculatorCtrl', function ($scope, $rootScope, servicecallback, formcheckservice) {

            $scope.options = [{name: "请选择", id: 0},{name: "40000 - 50000", id: 1}, {name: "50001 - 60000", id: 2},{name: "60001 - 70000", id: 3},{name: "70001 - 80000", id: 4}];
            $scope.selectedOption = $scope.options[0];
            $scope.customer = {isPR: true};
            
            $scope.getResult = function (customer) {
                $rootScope.$broadcast('isloading', true);
                var path = apiPath + "/bankratio";
                servicecallback.getmethod(path).then(function (result) {
                    $scope.banks = result.data;
                    $scope.isResult = true;
                    $rootScope.$broadcast('isloading', false);

                });

            };

            $scope.setPR = function (b) {
                $scope.customer.isPR = b;
            },
                    $scope.formatincome = function (income) {
                        var x = income.toString();
                        var pattern = /(-?\d+)(\d{3})/;
                        while (pattern.test(x))
                            x = x.replace(pattern, "$1,$2");
                        return x;
                    };

            $scope.isFormCorrect = function (customer) {

                var b = false;

                if (customer && formcheckservice.isemail(customer.email) && formcheckservice.isfilled(customer.surname)
                        && formcheckservice.isfilled(customer.givenname) && formcheckservice.isNumeric(customer.income)) {

                    b = true;

                }

                return b;
            };
        });