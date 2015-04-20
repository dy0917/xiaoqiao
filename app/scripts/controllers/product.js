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

            $scope.customer = {isPR: true};
            $scope.getResult = function (customer) {
                $rootScope.$broadcast('isloading', true);
                var path = apiPath + "/bankratio";
                servicecallback.getmethod(path).then(function (result) {
                    $scope.banks = result.data;
                    $scope.isResult = true;
                    $rootScope.$broadcast('isloading', false);

                });

//                }
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