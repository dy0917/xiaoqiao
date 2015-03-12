'use strict';

/**
 * @ngdoc function
 * @name xtripApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the xtripApp
 */
angular.module('xiaoqiaoApp')
        .controller('AboutCtrl', function($scope, $http, masonryService) {

            masonryService.masonryinit(50);



        });
angular.module('xiaoqiaoApp')
        .controller('testCtrl', function($scope, $http, masonryService) {

            $('#summernote').summernote(

                    );


        });
angular.module('xiaoqiaoApp')
        .controller('Subcribewindowcontroller', function($scope, servicecallback) {

            $scope.submit = function(subcribe) {
                var path = apiPath + "/subscribe";
                servicecallback.http(path, "POST", subcribe, function() {

                }, function() {
                });

            },
            $scope.unsubmit = function(subcribe) {
                var path = apiPath + "/subscribe/unsubscribe";
                servicecallback.http(path, "POST", subcribe, function() {

                }, function() {
                });

            }


        });