'use strict';

/**
 * @ngdoc function
 * @name xtripApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the xtripApp
 */
angular.module('xiaoqiaoApp')
        .controller('headerController', function($scope, $http, servicecallback, $rootScope, $location) {
            $scope.user = null;
            $scope.display = false;
            $scope.isloading = false;
            $scope.isSubscribewindow = false;


            $scope.login = function(user) {
                $scope.message = "";
                var hash = CryptoJS.MD5(user.password);
                user.password = hash.toString();
                var path = apiPath + "/site/login";
                servicecallback.http(path, "POST", user, function(data) {
                    if (data.error != "ERROR_USERNAME_INVALID")
                    {
                        $rootScope.user = data;
                        $scope.user = $rootScope.user;
                        $scope.toggleLogin();
                        $location.path("/distributor");
                    }
                    else {
                        $scope.message = "User name or Password not correct";
                    }
                }, function() {
                });
            };

            $scope.toRegisterPage = function() {

                $scope.toggleLogin();
                $location.path("/register");
            };
            $scope.toggleLogin = function() {

                $scope.display = !$scope.display;
            };
            $scope.togglespinner = function() {
//                $scope.display = !$scope.display;
            };
            $scope.toggleSubcribewindow = function() {
                $scope.isSubscribewindow = !$scope.isSubscribewindow;
            };
            $scope.$on('isloading', function(event, bool) {
                $scope.isloading = bool;
            });
            $scope.$on('routeupdate', function(event, route) {
                $scope.currentroute = route;
            });
            $scope.$on('toggleSubcribewindow', function(event, bool) {
                $scope.isSubscribewindow = bool;
            });


        });
