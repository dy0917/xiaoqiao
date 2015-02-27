'use strict';

/**
 * @ngdoc function
 * @name xtripApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the xtripApp
 */
angular.module('xiaoqiaoApp')
        .controller('headerController', function($scope, loginService) {
            $scope.user = null;
            $scope.display = false;
            $scope.isloading = false;
            $scope.login = function() {

                console.log($scope.user);

                //      $scope.$broadcast("myEvent", {username: "user.username" });
                //	loginService.login(data,$scope); //call login service
            };

            $scope.toggleLogin = function() {
                $scope.display = !$scope.display;
            };
            $scope.togglespinner = function() {
                $scope.display = !$scope.display;
            };
            $scope.$on('isloading', function(event, bool) {
                $scope.isloading = bool;
            });
        });
