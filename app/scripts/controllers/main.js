'use strict';
/**
 * @ngdoc function
 * @name xtripApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the xtripApp
 */
angular.module('xiaoqiaoApp')
        .controller('MainCtrl', function($scope, masonryService, servicecallback) {

            masonryService.masonryinit(50);
            $scope.getsliders = function() {
                var path = apiPath + "/slider/";
                servicecallback.http(path, "GET", null, function(data) {
                    $scope.sliders = data;
                    $scope.sliders.forEach(function(slider)
                    {
                        console.log(slider.imagelUrl);
                        var li = '<li><a ng-href="' + slider.linkto + '"><img src="' + slider.imagelUrl + '" title=' + slider.title + '"></a></li>';
                        $('#mainslider').append(li);
                    })
                    $('#banner-fade').bjqs({
                        height: 450,
                        width: 1600,
                        responsive: true
                    });
                }, function() {
                });
            };
            if (!$scope.sliders) {
                $scope.getsliders();
            }
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
