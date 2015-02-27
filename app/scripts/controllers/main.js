'use strict';

/**
 * @ngdoc function
 * @name xtripApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the xtripApp
 */
angular.module('xiaoqiaoApp')
        .controller('MainCtrl', function($scope, loginService, masonryService) {

            masonryService.masonryinit(50);
//            jQuery(document).ready(function($) {

            $('#banner-fade').bjqs({
                height: 450,
                width: 1600,
                responsive: true
            });

//            });
            // loginService.login();

            $scope.displayLogin = function() {
                //	loginService.login(data,$scope); //call login service
            };
            $scope.login = function(user) {
                console.log("login");
                //	loginService.login(data,$scope); //call login service
            };
            $scope.$on("myEvent", function(event, args) {

                console.log(event);
                console.log(args);
            });
        });
